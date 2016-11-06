<!DOCTYPE html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/template/admin/css/styles.css">
    <link rel="stylesheet" href="/template/admin/fonts/icons/icons.css">
    <link rel="stylesheet" href="/template/admin/css/application.css">
    <link rel="stylesheet" href="/template/admin/css/index.css">
    <title>Админпанель</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="my my_w"></div>
            <div class="auth_path">
                <ul>
                    <li><a href="" class="auth_link">
                        <div class="my my_k"></div>
                        <span>Admin: <?php echo $user['name']; ?></span>
                    </a></li>
                    <li><a href="/" class="auth_link auth_out">
                        Выход
                    </a></li>
                </ul>
            </div>
        </div>  
    </header>
    <ul class="date_time_path">
        <li>
            <div class="my my_j"></div>
            <span><?php
                $locale_time = setlocale (LC_TIME, 'ru_RU.UTF-8', 'Rus');

                function strf_time($format, $timestamp, $locale)
                {
                    $date_str = strftime($format, $timestamp);
                    if (strpos($locale, '1251') !== false)
                    {
                        return iconv('cp1251', 'utf-8', $date_str);
                    }
                    else
                    {
                        return $date_str;
                    }
                }

                echo strf_time("%d %B, %Y", time(), $locale_time);
            ?></span>
        </li>
        <li>
            <div class="my my_i"></div>
            <span>
            <?php 
                echo strftime("%H:%M");
            ?>    
            </span>
        </li>
    </ul>
    <main class="main_board container">

        <h1 class="my my_g main_board_h1"><span>Заказы</span>
        <form action="?" class="app_form_search" id="app_form_search">
            <div class="my my_h"></div>
            <input type="text" name="referal" id="app_search" class="app_search" placeholder="Введите № чека" value="">
            <ul class="search_result"></ul>
        </form>
        </h1>
        <div class="menu_main_board">
            <!--<ul>
                <li><a href="/admin/product">Управление товарами</a></li>
                <li><a href="/admin/category">Управление категориями</a></li>
                <li><a href="/admin/order">Управление заказами</a></li>
            </ul> -->
            <a id="all" class="menu_main_link" href="/admin/index">
                <div class="my my_a"></div>
                <div class="count_app"><?php echo $ordersAllCount["COUNT(*)"]; ?></div>
                <span>Все</span>
            </a>
            <a id="new" class="menu_main_link" href="/admin/orderlist/1">
                <div class="my my_b"></div>
                <div class="count_app"><?php echo $ordersNewCount["COUNT(*)"]; ?></div>
                <span>Новые</span>
            </a>
            <a id="accepted" class="menu_main_link" href="/admin/orderlist/2">
                <div class="my my_c"></div>
                <div class="count_app"><?php echo $ordersAcceptedCount["COUNT(*)"]; ?></div>
                <span>Принятые</span>
            </a>
            <a id="on_way" class="menu_main_link" href="/admin/orderlist/4">
                <div class="my my_d"></div>
                <div class="count_app"><?php echo $ordersOnwayCount["COUNT(*)"]; ?></div>
                <span>В пути</span>
            </a>
            <a id="completed" class="menu_main_link" href="/admin/orderlist/5">
                <div class="my my_e"></div>
                <div class="count_app"><?php echo $ordersFinishedCount["COUNT(*)"]; ?></div>
                <span>Завершенные</span>
            </a>
            <a id="deleted" class="menu_main_link" href="/admin/orderlist/6">
                <div class="my my_f"></div>
                <div class="count_app"><?php echo $ordersDeletedCount["COUNT(*)"]; ?></div>
                <span>Удаленные</span>
            </a>
        </div>

               