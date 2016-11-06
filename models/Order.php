<?php

/**
 * Класс Order - модель для работы с заказами
 */
class Order
{

    /**
     * Сохранение заказа 
     * @param string $userName <p>Имя</p>
     * @param string $userPhone <p>Телефон</p>
     * @param string $userComment <p>Комментарий</p>
     * @param integer $userId <p>id пользователя</p>
     * @param array $products <p>Массив с товарами</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function save($userName, $userId, $userSurname, $userAdress, $userPhone, $userComment, $userAdressDop, $products, $userPayMethod, $orderNumber, $orderStatus, $orderSumm)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO product_order (user_name, user_id, user_surname, user_adress, user_phone, user_comment, user_adressdop,  products, user_paymethod, user_ordernumber, user_orderstatus, order_summ) '
                . 'VALUES (:user_name, :user_id, :user_surname, :user_adress, :user_phone, :user_comment, :user_adressdop, :products, :user_paymethod, :user_ordernumber, :user_orderstatus, :order_summ)';

        $products = json_encode($products);

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_surname', $userSurname, PDO::PARAM_STR);
        $result->bindParam(':user_adress', $userAdress, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_adressdop', $userAdressDop, PDO::PARAM_STR);
        $result->bindParam(':products', $products, PDO::PARAM_STR);
        $result->bindParam(':user_paymethod', $userPayMethod, PDO::PARAM_STR);
        $result->bindParam(':user_ordernumber', $orderNumber, PDO::PARAM_STR);
        $result->bindParam(':user_orderstatus', $orderStatus, PDO::PARAM_STR);
        $result->bindParam(':order_summ', $orderSumm, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * Возвращает список заказов
     * @return array <p>Список заказов</p>
     */
    public static function getOrdersList()
    {


         // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM product_order ORDER BY id DESC';

        $ordersList = array();
        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Выполнение коменды
        $result->execute();
        

        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_surname'] = $row['user_surname'];
            $ordersList[$i]['user_adress'] = $row['user_adress'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $ordersList[$i]['user_comment'] = $row['user_comment'];
            $ordersList[$i]['user_adressdop'] = $row['user_adressdop'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['products'] = $row['products'];
            $ordersList[$i]['user_paymethod'] = $row['user_paymethod'];
            $ordersList[$i]['user_ordernumber'] = $row['user_ordernumber'];
            $ordersList[$i]['user_orderstatus'] = $row['user_orderstatus'];
            $i++;
        }
        return $ordersList;
    }

    // public static function getOrdersList()
    // {


    //      // Соединение с БД
    //     $db = Db::getConnection();

    //     // Текст запроса к БД
    //     $sql = 'SELECT * FROM product_order ORDER BY id DESC';

    //     $ordersList = array();
    //     // Используется подготовленный запрос
    //     $result = $db->prepare($sql);

    //     // Указываем, что хотим получить данные в виде массива
    //     $result->setFetchMode(PDO::FETCH_ASSOC);
        
    //     // Выполнение коменды
    //     $result->execute();
        

    //     $i = 0;
    //     while ($row = $result->fetch()) {
    //         $ordersList[$i]['id'] = $row['id'];
    //         $ordersList[$i]['user_name'] = $row['user_name'];
    //         $ordersList[$i]['user_surname'] = $row['user_surname'];
    //         $ordersList[$i]['user_adress'] = $row['user_adress'];
    //         $ordersList[$i]['user_phone'] = $row['user_phone'];
    //         $ordersList[$i]['user_comment'] = $row['user_comment'];
    //         $ordersList[$i]['user_adressdop'] = $row['user_adressdop'];
    //         $ordersList[$i]['date'] = $row['date'];
    //         $ordersList[$i]['products'] = $row['products'];
    //         $ordersList[$i]['user_paymethod'] = $row['user_paymethod'];
    //         $ordersList[$i]['user_ordernumber'] = $row['user_ordernumber'];
    //         $ordersList[$i]['user_orderstatus'] = $row['user_orderstatus'];
    //         $i++;
    //     }
    //     return $ordersList;
    // }

    public static function getOrderListByStatus($status)
    {


        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM product_order WHERE user_orderstatus = :status';

        $ordersListFiltered = array();

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':status', $status, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

         $i = 0;
        while ($row = $result->fetch()) {
            $ordersListFiltered[$i]['id'] = $row['id'];
            $ordersListFiltered[$i]['user_name'] = $row['user_name'];
            $ordersListFiltered[$i]['user_surname'] = $row['user_surname'];
            $ordersListFiltered[$i]['user_adress'] = $row['user_adress'];
            $ordersListFiltered[$i]['user_phone'] = $row['user_phone'];
            $ordersListFiltered[$i]['user_comment'] = $row['user_comment'];
            $ordersListFiltered[$i]['user_adressdop'] = $row['user_adressdop'];
            $ordersListFiltered[$i]['date'] = $row['date'];
            $ordersListFiltered[$i]['products'] = $row['products'];
            $ordersListFiltered[$i]['user_paymethod'] = $row['user_paymethod'];
            $ordersListFiltered[$i]['user_ordernumber'] = $row['user_ordernumber'];
            $ordersListFiltered[$i]['user_orderstatus'] = $row['user_orderstatus'];
            $i++;
        }
        return $ordersListFiltered;

    }

    public static function getCountAllOrders(){
          // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT COUNT(*) FROM `product_order` WHERE `user_orderstatus` <> "6" ';

        $ordersAllCount = array();
        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Выполнение коменды
        $result->execute();

        $ordersAllCount = $result->fetch();

        return $ordersAllCount;
    }

    public static function getCountNewOrders(){
          // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT COUNT(*) FROM `product_order` WHERE `user_orderstatus` = "1" ';

        $ordersNewCount = array();
        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Выполнение коменды
        $result->execute();

        $ordersNewCount = $result->fetch();

        return $ordersNewCount;
    }

    public static function getCountAcceptedOrders(){
          // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT COUNT(*) FROM `product_order` WHERE `user_orderstatus` = "2" ';

        $ordersAcceptedCount = array();
        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Выполнение коменды
        $result->execute();

        $ordersAcceptedCount = $result->fetch();

        return $ordersAcceptedCount;
    }

     public static function getCountOnwayOrders(){
          // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT COUNT(*) FROM `product_order` WHERE `user_orderstatus` = "4" ';

        $ordersOnwayCount = array();
        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Выполнение коменды
        $result->execute();

        $ordersOnwayCount = $result->fetch();

        return $ordersOnwayCount;
    }

    public static function getCountFinishedOrders(){
          // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT COUNT(*) FROM `product_order` WHERE `user_orderstatus` = "5" ';

        $ordersFinishedCount = array();
        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Выполнение коменды
        $result->execute();

        $ordersFinishedCount = $result->fetch();

        return $ordersFinishedCount;
    }

    public static function getCountDeletedOrders(){
          // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT COUNT(*) FROM `product_order` WHERE `user_orderstatus` = "6" ';

        $ordersDeletedCount = array();
        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Выполнение коменды
        $result->execute();

        $ordersDeletedCount = $result->fetch();

        return $ordersDeletedCount;
    }

    

    /**
     * Возвращает текстое пояснение статуса для заказа :<br/>
     * <i>1 - Новый заказ, 2 - В обработке, 3 - Доставляется, 4 - Закрыт</i>
     * @param integer $status <p>Статус</p>
     * @return string <p>Текстовое пояснение</p>
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return '<td class="app_status_new">Новый</td>';
                break;
            case '2':
                return '<td class="app_status_accepted">Принят</td>';
                break;
            case '3':
                return '<td class="app_status_accepted">Приготовлен</td>';
                break;    
            case '4':
                return '<td class="app_status_onway">В пути</td>';
                break;
            case '5':
                return '<td class="app_status_onway">Завершен</td>';
                break;
            case '6':
                return '<td class="app_status_onway">Удален</td>';
                break;
        }
    }

    /**
     * Возвращает заказ с указанным id 
     * @param integer $id <p>id</p>
     * @return array <p>Массив с информацией о заказе</p>
     */
    public static function getOrderById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM product_order WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Возвращаем данные
        return $result->fetch();
    }

    /**
     * Возвращает все заказы с указанным id пользователя
     * @param integer $id <p>id</p>
     * @return array <p>Массив с заказами</p>
     */
    public static function getOrderByUserId($userId)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT id, user_id, user_name, user_surname, user_adress, user_phone, user_comment, user_adressdop, `date`, products, user_paymethod, user_ordernumber, user_orderstatus, order_summ FROM product_order WHERE user_id = :id';

        $ordersListId = array();
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Выполнение коменды
        $result->execute();
        

        $i = 0;
        while ($row = $result->fetch()) {
            $ordersListId[$i]['id'] = $row['id'];
            $ordersListId[$i]['user_name'] = $row['user_name'];
            $ordersListId[$i]['user_surname'] = $row['user_surname'];
            $ordersListId[$i]['user_adress'] = $row['user_adress'];
            $ordersListId[$i]['user_phone'] = $row['user_phone'];
            $ordersListId[$i]['user_comment'] = $row['user_comment'];
            $ordersListId[$i]['user_adressdop'] = $row['user_adressdop'];
            $ordersListId[$i]['date'] = $row['date'];
            $ordersListId[$i]['products'] = $row['products'];
            $ordersListId[$i]['user_paymethod'] = $row['user_paymethod'];
            $ordersListId[$i]['user_ordernumber'] = $row['user_ordernumber'];
            $ordersListId[$i]['user_orderstatus'] = $row['user_orderstatus'];
            $ordersListId[$i]['order_summ'] = $row['order_summ'];
            $i++;
        }
        return $ordersListId;

    }

    public static function getCountUserOrders($userId){
          // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT COUNT(*) FROM `product_order` WHERE user_id = :id';

        $ordersDeletedCount = array();
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Выполнение коменды
        $result->execute();

        $ordersUserCount = $result->fetch();

        return $ordersUserCount;
    }



    /**
     * Удаляет заказ с заданным id
     * @param integer $id <p>id заказа</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteOrderById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM product_order WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редактирует заказ с заданным id
     * @param integer $id <p>id товара</p>
     * @param string $userName <p>Имя клиента</p>
     * @param string $userPhone <p>Телефон клиента</p>
     * @param string $userComment <p>Комментарий клиента</p>
     * @param string $date <p>Дата оформления</p>
     * @param integer $status <p>Статус <i>(включено "1", выключено "0")</i></p>
     * @return boolean <p>Результат выполнения метода</p>
     */


    public static function updateOrderById($id, $products, $orderStatus, $orderSumm, $orderPhone, $orderAdress, $orderName, $orderComment, $orderCommentAdmin)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE product_order
            SET  
                products = :products,
                user_orderstatus =:user_orderstatus, 
                order_summ = :order_summ, 
                user_phone = :user_phone,
                user_adress = :user_adress, 
                user_name = :user_name, 
                user_comment = :user_comment, 
                del_comment = :del_comment 
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':products', $products, PDO::PARAM_STR);
        $result->bindParam(':user_orderstatus', $orderStatus, PDO::PARAM_STR);
        $result->bindParam(':order_summ', $orderSumm, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $orderPhone, PDO::PARAM_STR);
        $result->bindParam(':user_adress', $orderAdress, PDO::PARAM_STR);
        $result->bindParam(':user_name', $orderName, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $orderComment, PDO::PARAM_STR);
        $result->bindParam(':del_comment', $orderCommentAdmin, PDO::PARAM_STR);
        return $result->execute();
        return true;
    }

    public static function getCashCard($value){

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM card WHERE `number` = :value';

        $result = $db->prepare($sql);
        $result->bindParam(':value', $value, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Возвращаем данные
        return $result->fetch();

    }

    public static function selectMaxOrderNumber(){

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT MAX(user_ordernumber) AS user_ordernumber FROM product_order';

        $result = $db->prepare($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Возвращаем данные
        return $result->fetch();

    }

}
