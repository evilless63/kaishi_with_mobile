<?php

/**
 * Контроллер CabinetController
 * Кабинет пользователя
 */
class CabinetController
{

    /**
     * Action для страницы "Кабинет пользователя"
     */
    public function actionIndex()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);



        // Получаем список заказов
        $ordersList = Order::getOrdersList();


        // Получаем список заказов по вошедшему пользователю
        $ordersListId = Order::getOrderByUserId($userId);

        // Получаем количество заказов по вошедшему пользователю
        $ordersCount = Order::getCountUserOrders($userId);

         // Получим идентификаторы и количество товаров в корзине
        $productsInCart = Cart::getProducts();
        if ($productsInCart) {
            // Если в корзине есть товары, получаем полную информацию о товарах для списка
            // Получаем массив только с идентификаторами товаров
            $productsIds = array_keys($productsInCart);

            // Получаем массив с полной информацией о необходимых товарах
            $products = Product::getProdustsByIds($productsIds);

            // Получаем общую стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        } else {
            $totalPrice = "0";
        }

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }

    /**
     * Action для страницы "Редактирование данных пользователя"
     */
    public function actionEdit()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        // Заполняем переменные для полей формы
        $name = $user['name'];
        $surname = $user['surname'];
        $login = $user['login'];
        $phone = $user['phone'];
        $email = $user['email'];
        $password = $user['password'];

        // Флаг результата
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $login = $_POST['login'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            // Флаг ошибок
            $errors = false;

            // Валидируем значения
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if ($errors == false) {
                // Если ошибок нет, сохраняет изменения профиля
                $result = User::edit($userId, $name, $password, $surname, $login, $phone, $email);
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/edit.php');
        return true;
    }

    // Отправка отзыва клиента со страницы личного кабинета

    public function actionAddfeedback()
    {

        if(isset($_POST['goFeedback'])) {
            $name = $_POST['name'];
            $image = $_POST['image'];
            $date = date("d.m.y");
            $text = $_POST['text'];
            $mark = $_POST['mark'];

            $result = User::addFeedback($name, $image, $date, $text, $mark);
        }

    }

}
