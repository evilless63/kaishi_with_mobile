<?php include ROOT . '/views/layouts/header.php'; ?>
<main>
        <div class="mainWrapLC container row toSpaceBetween">
            <div class="content lcContent">
                <h1 class="lcContentHeader">Личный кабинет</h1>
                <div class="lcContentRow">
                    <div class="lcContentBlock">
                        <img src="/template/images/icons/feedback__default.svg" alt="">
                        <div class="lcContentBlockDesc"><?php echo $user['name'];?></div>
                    </div>
                    <div class="lcContentBlock">
                        <img src="/template/images/icons/contacts__phone.svg" alt="">
                        <div class="lcContentBlockDesc"><?php echo $user['phone'];?></div>
                    </div>
                    <div class="lcContentBlock">
                        <img class="lcContentBlockImg" src="/template/images/icons/lc__countZakaz.png" alt="">
                        <div class="lcContentBlockDesc">кол-во заказов : 
                        <?php 
                            if(!isset($ordersCount["COUNT(*)"])) {
                                echo "0";
                            } else {
                                echo $ordersCount["COUNT(*)"];
                            } 
                        ?>
                        </div>
                    </div>
                </div>
                <div class="lcContentTabs tabs">
                    <ul class="tabs__caption">
                        <li class="active">Мои заказы</li>
                        <li>Адреса и контакты</li>
                        <li>Настройки</li>
                    </ul>
                    <div class="tabs__content zakaz active">
                    <?php 
                        $orderCount = 1;
                        foreach($ordersListId as $order):


                    ?>
                        <div class="zakazRow">
                            <div class="zakazRowNumber">Заказ # <?php echo $order['user_ordernumber']; ?> от <?php echo $order['date']; ?></div>
                            <div class="zakazRowSpoiler spoiler" data-spoiler-link="<?php echo $orderCount; ?>">
                                <img src="/template/images/icons/lc__arrowBottom.png" alt="">
                            </div>
                            <div class="zakazRowStatus"><?php echo Order::getStatusText($order['user_orderstatus']); ?></div>
                            <div class="zakazRowSchedule">Оставить отзыв</div>
                        </div>
                        <div class="spoilerContent spoiler-content" data-spoiler-link="<?php echo $orderCount; ?>">
                            <?php 

                            $products = Product::getProdustsByIds(array_keys(json_decode($order['products'], true)));
                            $productsQuantity = json_decode($order['products'], true);
                            foreach ($products as $product):?>
                            <div class="zakazRowSpoilerWrap">
                                <img src="<?php echo Product::getImage($product['id']); ?>" alt="<?php echo $product['name']; ?>">
                                <div class="zakazRowSpoilerWrapName">
                                    <?php echo $product['name']; ?>
                                </div>
                                <div class="zakazRowSpoilerWrapWeight">
                                    
                                </div>
                                <div class="zakazRowSpoilerWrapCount">
                                    <?php echo $productsQuantity[$product['id']]; ?> шт
                                </div>
                                <div class="zakazRowSpoilerWrapCost">
                                    <?php echo $product['price']; ?> р.
                                </div>
                                <div class="zakazRowSpoilerWrapCart add-to-cart" data-id="<?php echo $product['id']; ?>" >
                                    В корзину
                                </div>
                            </div>
                            <?php endforeach;?> 
                            <div class="zakazRowSpoilerDesc">
                                <div class="zakazRowScheduleDesc">Повторить заказ</div>
                                <!-- <span>Количество персон: 3</span> -->
                                <span>АДРЕС ДОСТАВКИ: <?php echo $order['user_adress']; ?></span>
                                <span>Номер телефона: <?php echo $order['user_phone']; ?></span>
                                <span>Оплата: <?php echo $order['user_paymethod']; ?><br>  
                                <!-- Начислено 22 бонусов<br>
                                Списано 0 бонусов<br>   -->  </span>
                                <span>ОБЩАЯ СТОИМОСТЬ ЗАКАЗА: <?php echo $order['order_summ']; ?> руб.</span>
                            </div>
                        </div>
                    <?php 
                    $orderCount++;
                    endforeach; ?>    
                    </div>
                    
                    <div class="tabs__content zakaz">
                        <div class="adressRow">
                            <span>АДРЕС ДОСТАВКИ: 
                            <?php 
                                if (!isset($order)) { 
                                    echo "Не указано ни одного адреса, желаете создать новый ?</span>";
                                } else {
                                    echo $order['user_adress'].  
                                    '</span>'.
                                    '<div class="adressRowEdit">'.
                                        '<img src="/template/images/icons/lc__addresEdit.png" alt="">'.
                                    '</div>'.
                                    '<div class="adressRowDelete">'.
                                        '<img src="/template/images/icons/misc__delete.svg" alt="">'.
                                    '</div>';
                                }   
                            ?>
                            
                        </div>
                        <div class="row">
                            <textarea rows="5" name="userComment" cols="60" class="addAdressField" placeholder="Укажите Ваш адрес..."></textarea>
                            <div class="adressAdd">Добавить адрес</div>
                        </div>
                    </div>
                    <div class="tabs__content zakaz">
                        <div class="settingsRow login">
                            <div class="settingsLogin">Логин</div>
                            <input type="text" value="<?php echo $user['login'];?>" id="settingsLoginInput" name="settingsLoginInput">
                        </div>
                        <div class="settingsRow name">
                            <div class="settingsName">Имя</div>
                            <input type="text" value="<?php echo $user['name'];?>" id="settingsNameInput" name="settingsNameInput">
                        </div>
                        <div class="settingsRow surname">
                            <div class="settingsSurname">Фамилия</div>
                            <input type="text" value="<?php echo $user['surname'];?>" id="settingsSurnameInput" name="settingsSurnameInput">
                        </div>
                        <div class="settingsRow phone">
                            <div class="settingsPhone">Телефон</div>
                            <input type="text" value="<?php echo $user['phone'];?>" id="settingsPhoneInput" name="settingsPhoneInput">
                        </div>

                        <!-- <div class="settingsRow bday">
                            <div class="settingsBday">День рождения</div>
                            <input type="text" value="" id="settingsBdayInput" name="settingsBdayInput">
                        </div> -->
                        <!-- <div class="settingsRow sms">
                            <div class="settingsSms">Принимать SMS рассылки</div>
                            <input type="checkbox" value="checked" id="settingsSmsInput" name="settingsSmsInput">
                        </div> -->
                        <div class="settingsRow mail">
                            <div class="settingsMail">Email адрес</div>
                            <input type="text" value="<?php echo $user['email'];?>" id="settingsMailInput" name="settingsMailInput">
                        </div>
                        <!-- <div class="settingsRow mailRassylka">
                            <div class="settingsMailRassylka">Получать Email рассылку</div>
                            <input type="checkbox" value="checked" id="settingsMailRassylkaInput" name="settingsMailRassylkaInput">
                        </div> -->
                        <div class="row">
                            <div class="passwordEdit"><a href="/cabinet/edit">Редактировать данные</a></div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </main>
    <div class="feedbackLCwrapper">
        <div class="feedbackLCcontent">
            <div class="feedbackLCuserinfo">
                <img class="feedbackLCimage" src="<?php echo $user['image'];?>" alt="Фотография <?php echo $user['name'];?>">
                <div class="feedbackLCname" id="feedbackLCname"><?php echo $user['name'];?></div>
            </div>
            <span>Текст отзыва</span>
            <textarea name="feedbackLCtext" class="feedbackLCtext" id="feedbackLCtext" cols="30" rows="10"></textarea>
            <span>Поставьте оценку</span>
            <select name="feedbackLCmark" class="feedbackLCmark" id="feedbackLCmark">
                <option value="1">Ужасно</option>
                <option value="2">Плохо</option>
                <option value="3">Сойдет</option>
                <option value="4">Хорошо</option>
                <option value="5">Отлично</option>
            </select>
            <div class="feedbackLCsend">
                Отправить
            </div>
        </div>
    </div>    
<?php include ROOT . '/views/layouts/footer.php'; ?>