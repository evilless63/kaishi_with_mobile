<?php
ini_set('error_reporting', E_ALL);
// Подключаем библиотеку
require_once "Classes/PHPExcel.php";

// Функция преобразования листа Excel в таблицу MySQL, с учетом объединенных строк и столбцов.
// Значения берутся уже вычисленными. Параметры:
//     $worksheet - лист Excel
//     $connection - соединение с MySQL (mysqli)
//     $table_name - имя таблицы MySQL
//     $columns_name_line - строка с именами столбцов таблицы MySQL (0 - имена типа column + n)
function excel2mysql($worksheet, $connection, $table_name, $columns_name_line = 0) {
  // Проверяем соединение с MySQL
  if (!$connection->connect_error) {
    // Строка для названий столбцов таблицы MySQL
    $columns_str = "";
    // Количество столбцов на листе Excel
    $columns_count = PHPExcel_Cell::columnIndexFromString($worksheet->getHighestColumn());

    // Перебираем столбцы листа Excel и генерируем строку с именами через запятую
    for ($column = 0; $column < $columns_count; $column++) {
      $columns_str .= ($columns_name_line == 0 ? "column" . $column : $worksheet->getCellByColumnAndRow($column, $columns_name_line)->getCalculatedValue()) . ",";
    }

    // Обрезаем строку, убирая запятую в конце
    $columns_str = substr($columns_str, 0, -1);

    // Удаляем таблицу MySQL, если она существовала
    if ($connection->query("DROP TABLE IF EXISTS `product`;")) {
      // Создаем таблицу MySQL
      if ($connection->query("CREATE TABLE `product` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `category_id` int(11) NOT NULL,
        `size` int(11) NOT NULL,
        `code` int(11) NOT NULL,
        `price` float NOT NULL,
        `availability` int(11) NOT NULL,
        `brand` varchar(255) NOT NULL,
        `image` varchar(255) NOT NULL,
        `description` text NOT NULL,
        `is_new` int(11) NOT NULL DEFAULT '0',
        `is_recommended` int(11) NOT NULL DEFAULT '0',
        `status` int(11) NOT NULL DEFAULT '1',
        `product_type` varchar(255) NOT NULL DEFAULT '1',
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

        ")) {
        // Количество строк на листе Excel
        $rows_count = $worksheet->getHighestRow();

        // Перебираем строки листа Excel
        for ($row = $columns_name_line + 1; $row <= $rows_count; $row++) {
          // Строка со значениями всех столбцов в строке листа Excel
          $value_str = "";

          // Перебираем столбцы листа Excel
          for ($column = 0; $column < $columns_count; $column++) {
            // Строка со значением объединенных ячеек листа Excel
            $merged_value = "";
            // Ячейка листа Excel
            $cell = $worksheet->getCellByColumnAndRow($column, $row);

            // Перебираем массив объединенных ячеек листа Excel
            foreach ($worksheet->getMergeCells() as $mergedCells) {
              // Если текущая ячейка - объединенная,
              if ($cell->isInRange($mergedCells)) {
                // то вычисляем значение первой объединенной ячейки, и используем её в качестве значения
                // текущей ячейки
                $merged_value = $worksheet->getCell(explode(":", $mergedCells)[0])->getCalculatedValue();
                break;
              }
            }

            // Проверяем, что ячейка не объединенная: если нет, то берем ее значение, иначе значение первой
            // объединенной ячейки
            $value_str .= "'" . (strlen($merged_value) == 0 ? $cell->getCalculatedValue() : $merged_value) . "',";
          }

          // Обрезаем строку, убирая запятую в конце
          $value_str = substr($value_str, 0, -1);

          // Добавляем строку в таблицу MySQL
          $connection->query("INSERT INTO " . $table_name . " (" . $columns_str . ") VALUES (" . $value_str . ")");
        }
      } else {
        return false;
        echo "Не создал таблицу";
      }
    } else {
      return false;
      echo "Не могу удалить таблицу";
    }
  } else {
    return false;
    echo "Нет соединения с бд";
  }

  return true;
}

// Соединение с базой MySQL
$connection = new mysqli("localhost", "root", "", "phpshop");
// Выбираем кодировку UTF-8
$connection->set_charset("utf8");

// Загружаем файл Excel
$PHPExcel_file = PHPExcel_IOFactory::load("products_re_vos2.xlsx");

// Преобразуем первый лист Excel в таблицу MySQL
$PHPExcel_file->setActiveSheetIndex(0);
echo excel2mysql($PHPExcel_file->getActiveSheet(), $connection, "product", 1) ? "Данные успешно загружены\n" : "FAIL\n";

// Перебираем все листы Excel и преобразуем в таблицу MySQL
foreach ($PHPExcel_file->getWorksheetIterator() as $index => $worksheet) {
  echo excel2mysql($worksheet, $connection, "product" . ($index != 0 ? $index : ""), 1) ? "Данные успешно загружены\n" : "FAIL\n";
}