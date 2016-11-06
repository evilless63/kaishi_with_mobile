<?php include ROOT . '/views/layouts/header_admin_main.php'; ?>

    <div class="logo">
        <img src="/template/admin/images/logo.png" alt="лого">
    </div>
    <form class="loginForm" action="" method="post">
        <img src="/template/admin/images/loginIcon.png" alt="">
        <input type="text" name="loginFormLogin" class="loginFormLogin" id="loginFormLogin" placeholder="Введите почту">
        <input type="password" name="loginFormPass" class="loginFormPass" id="loginFormPass" placeholder="Введите пароль">
        <div class="loginFormEnter">
            <input type="submit" name="submit" value="Войти">
            <!-- <a href="main.html">Войти</a> -->
        </div>
        <div class="loginFormForgetPass">
            <a href="">Забыли пароль ?</a>
        </div>
    </form>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>