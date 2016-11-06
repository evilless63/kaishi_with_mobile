<?php

/**
 * Контроллер AdminController
 * Главная страница в админпанели
 */
class AdminController extends AdminBase
{
    /**
     * Action для стартовой страницы "Панель администратора"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();
        // self::checkAdminVerified();

        $userId = User::getUser();
        $user = User::getUserById($userId);

        // Получаем список заказов
        $ordersList = Order::getOrdersList();

        $ordersAllCount = Order::getCountAllOrders();

        $ordersNewCount = Order::getCountNewOrders();

        $ordersAcceptedCount = Order::getCountAcceptedOrders();

        $ordersOnwayCount = Order::getCountOnwayOrders();

        $ordersFinishedCount = Order::getCountFinishedOrders();

        $ordersDeletedCount = Order::getCountDeletedOrders();

        // Подключаем вид
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

    public function actionMain()
    {
        // Проверка доступа
        self::checkAdmin();
        $user['name'] = "none";
        // Переменные для формы
        $email = false;
        $password = false;
        
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена 
            // Получаем данные из формы
            $email = $_POST['loginFormLogin'];
            $password = $_POST['loginFormPass'];

            // Флаг ошибок
            $errors = false;
            // Проверяем существует ли пользователь
            $userId = User::checkUserData($email, $password);

            // Получаем информацию о текущем пользователе
            $user = User::getUserById($userId);
            // Если роль текущего пользователя "admin", пускаем его в админпанель
            if ($user['role'] == 'admin') {
                // $user['is_verified'] == 1;
                header("Location: /admin/index");
                return true;
            } else {
                die('Access denied');
            }

            // Иначе завершаем работу с сообщением об закрытом доступе
            die('Access denied');
            
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin/login.php');
        return true;
    }
     
    

    



}
