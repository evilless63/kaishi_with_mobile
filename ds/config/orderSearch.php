<?php
	
	define("DB_HOST","localhost");
	define("DB_NAME","phpshop"); //Имя базы
	define("DB_USER","root"); //Пользователь
	define("DB_PASSWORD",""); //Пароль
	
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$mysqli -> query("SET NAMES 'utf8'") or die ("Ошибка соединения с базой!");
	
	if(!empty($_POST["referal"])){ //Принимаем данные
	
	    $referal = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["referal"]))));
	
	    $db_referal = $mysqli -> query("SELECT * from product_order WHERE user_ordernumber LIKE '%$referal%'")
	    or die('Ошибка №'.__LINE__.'<br>Обратитесь к администратору сайта пожалуйста, сообщив номер ошибки.');
	
	    while ($row = $db_referal -> fetch_array()) {
	        echo "\n<li><a href=\"/admin/order/view/".$row["id"]."\">".$row["user_ordernumber"]."</a></li>"; //$row["name"] - имя поля таблицы
	    }
	
	}
