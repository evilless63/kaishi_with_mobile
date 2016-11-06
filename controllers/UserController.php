<?php

/**
 * Контроллер UserController
 */
class UserController
{
    /**
     * Action для страницы "Регистрация"
     */
    public function actionRegister()
    {
        // Переменные для формы
        $login = false;
        $name = false;
        $surname = false;
        $phone = false;
        $email = false;
        $password = false;
        $result = false;

        // Обработка формы
        if (isset($_POST['goRegister']) && isset($_POST['polzSogl'])) {
            // Если форма отправлена 
            // Получаем данные из формы
            $login = $_POST['login'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Флаг ошибок
            $errors = false;

            $result = User::register($login, $name, $surname, $phone, $email, $password);


        }

     
        return true;
    }
    
    /**
     * Action для страницы "Вход на сайт"
     */
    public function actionLogin()
    {
        // Переменные для формы
        $email = false;
        $password = false;
        
        // Обработка формы
        if (isset($_POST['gologin'])) {
            // Если форма отправлена 
            // Получаем данные из формы
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Флаг ошибок
            $errors = false;
            // Проверяем существует ли пользователь
            $userId = User::checkUserData($email, $password);

            if(isset($userId)) {
              // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId);  
                $info = "Вы успешно вошли !";
            } else {
                $info = 'Не правильно указан e-mail и(или) пароль !';
            }

        }

        echo $info;
    }

    /**
     * Action для страницы "Вход на сайт с телефоном"
     */
    public function actionLoginbyphone()
    {
        // Переменные для формы
        $phone = false;

        // Обработка формы
        if (isset($_POST['gologin'])) {
            // Если форма отправлена 
            // Получаем данные из формы
            $phone = $_POST['phone'];

            // Флаг ошибок
            $errors = false;
            // Проверяем существует ли пользователь
            $userId = User::checkUserDataByPhone($email, $password);

            
            // Если данные правильные, запоминаем пользователя (сессия)
            User::auth($userId);

            // Перенаправляем пользователя в закрытую часть - кабинет 
            // header("Location: /cabinet");
            
        }

        // Подключаем вид
        require_once(ROOT . '/views/user/login.php');
        return true;
    }

    /**
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout()
    {
        // Стартуем сессию
        // session_start();
        
        // Удаляем информацию о пользователе из сессии
        unset($_SESSION["user"], $_SESSION['products']);
        
        // Перенаправляем пользователя на главную страницу
        header("Location: /");
    }

}
