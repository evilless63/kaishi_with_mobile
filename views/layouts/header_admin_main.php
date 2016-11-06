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
               