<?php

/**
 * Контроллер AdminOrderController
 * Управление заказами в админпанели
 */
class AdminOrderController extends AdminBase
{

    /**
     * Action для страницы "Управление заказами"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

          // Получаем список заказов
        $ordersList = Order::getOrdersList();

        $ordersAllCount = Order::getCountAllOrders();

        $ordersNewCount = Order::getCountNewOrders();

        $ordersAcceptedCount = Order::getCountAcceptedOrders();

        $ordersOnwayCount = Order::getCountOnwayOrders();

        $ordersFinishedCount = Order::getCountFinishedOrders();

        $ordersDeletedCount = Order::getCountDeletedOrders();

        // Подключаем вид
        // require_once(ROOT . '/views/admin_order/index.php');
        return true;
    }

    public function actionOrderlist($id)
    {
        // Проверка доступа
        self::checkAdmin();

        $userId = User::getUser();
        $user = User::getUserById($userId);

        // Получаем список заказов
        $ordersListFiltered = Order::getOrderListByStatus($id);

        $ordersAllCount = Order::getCountAllOrders();

        $ordersNewCount = Order::getCountNewOrders();

        $ordersAcceptedCount = Order::getCountAcceptedOrders();

        $ordersOnwayCount = Order::getCountOnwayOrders();

        $ordersFinishedCount = Order::getCountFinishedOrders();

        $ordersDeletedCount = Order::getCountDeletedOrders();

        // Подключаем вид
        require_once(ROOT . '/views/admin/orderlist.php');
        return true;
    }

    /**
     * Action для страницы "Редактирование заказа"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        // self::checkAdmin();

        // Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);

        // Обработка формы
        if (isset($_POST['goUpdate'])) {
            // Если форма отправлена   
            // Получаем данные из формы
            $products = $_POST['products'];
            $orderStatus = intval($_POST['orderStatus']);
            $orderSumm = intval($_POST['orderSumm']);

            $orderPhone = $_POST['orderPhone'];
            $orderAdress = $_POST['orderAdress'];
            $orderName = $_POST['orderName'];
            $orderComment = $_POST['orderComment'];

            $orderCommentAdmin = $_POST['orderCommentAdmin'];

            // Сохраняем изменения
            $result = Order::updateOrderById($id, $products, $orderStatus, $orderSumm, $orderPhone, $orderAdress, $orderName, $orderComment, $orderCommentAdmin);
            if (isset($result)){
                var_dump($result);
            } else {
                echo "FAKE";
            }
            
            // Перенаправляем пользователя на страницу управлениями заказами
            // header("Location: /admin/order/view/$id");
        }

        // // Подключаем вид
        // require_once(ROOT . '/views/admin_order/update.php');
        return true;
    }

    /**
     * Action для страницы "Просмотр заказа"
     */
    public function actionView($id)
    {
        // Проверка доступа
        self::checkAdmin();

        $userId = User::getUser();
        $user = User::getUserById($userId);

        // Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);

        // Список категорий для выпадающего меню
        $categories = Category::getCategoriesList();

        // Получаем массив с идентификаторами и количеством товаров
        $productsQuantity = json_decode($order['products'], true);

        // Получаем массив с индентификаторами товаров
        $productsIds = array_keys($productsQuantity);

        // Получаем список товаров в заказе
        $products = Product::getProdustsByIds($productsIds);

          // Получаем список заказов
        $ordersList = Order::getOrdersList();

        $ordersAllCount = Order::getCountAllOrders();

        $ordersNewCount = Order::getCountNewOrders();

        $ordersAcceptedCount = Order::getCountAcceptedOrders();

        $ordersOnwayCount = Order::getCountOnwayOrders();

        $ordersFinishedCount = Order::getCountFinishedOrders();

        $ordersDeletedCount = Order::getCountDeletedOrders();

        // Подключаем вид
        require_once(ROOT . '/views/admin_order/view.php');
        return true;
    }



    public function actionGetcategory($categoryId)
    {
        $page = 1;
         //Получаем список товаров в конкретной категории
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);

        $answer = json_encode($categoryProducts);
        echo $answer;

    }

    /**
     * Action для страницы "Удалить заказ"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем заказ
            Order::deleteOrderById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/order");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_order/delete.php');
        return true;
    }

}
