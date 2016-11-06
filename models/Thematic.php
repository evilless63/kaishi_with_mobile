<?php

class Thematic
{

    public static function getThematicList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT id, name, description FROM thematic ORDER BY id ASC');

        // Получение и возврат результатов
        $i = 0;
        $thematicList = array();
        while ($row = $result->fetch()) {
            $thematicList[$i]['id'] = $row['id'];
            $thematicList[$i]['name'] = $row['name'];
            $thematicList[$i]['description'] = $row['description'];
            $i++;
        }
        return $thematicList;
    }

    public static function getThematicById($id)
    {
      // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM thematic WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        return $result->fetch();  
    }
}    