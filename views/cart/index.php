<?php include ROOT . '/views/layouts/header.php'; ?>
<main>
        <div class="mainWrap mainWrapCart mainWrapAkcii container row toSpaceBetween">
            <div class="content">
                <h1 class="headerContent">Оформление заказа</h1>
                <div class="row">
                    <div class="cartProductsBlock">
                        <?php if ($productsInCart): ?>
                            <?php foreach ($products as $product): ?>
                                <div class="row cartProductsBlockContent">
                                    <img class="cartPaymentBlockMiscImg" src="<?php echo Product::getImage($simpleProduct['id'])?>" alt="<?php echo $product['name'];?>">
                                    <div class="cartProductsBlockName"><?php echo $product['name'];?></div>
                                    <div class="cartProductsBlockCount row">
                                        <a href="/cart/minus/<?php echo $product['id'];?>" class="cartProductsBlockCountMinus">
                                            <img src="template/images/icons/misc__minus.svg" alt="">
                                        </a>
                                        <input type="text" class="cartProductsBlockInputcount" value="<?php echo $productsInCart[$product['id']];?>">
                                        <a href="/cart/plus/<?php echo $product['id'];?>" class="cartProductsBlockPlus">
                                            <img src="template/images/icons/misc__plus.svg" alt="">
                                        </a>
                                    </div>
                                    <div class="cartProductsBlockCost"><?php echo $product['price'];?></div>
                                    <div class="cartProductsBlockDelete">
                                        <a href="/cart/delete/<?php echo $product['id'];?>">
                                            <img src="template/images/icons/misc__delete.svg" alt="">
                                        </a> 
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="row">
                                <div class="cartProductsBlockComment">
                                    <div class="addCommentButton">
                                        Добавить комментарий к заказу
                                    </div>
                                    <textarea rows="5" name="userComment" cols="60" class="addCommentField" placeholder="Комментарий к заказу..."></textarea>
                                </div>  
                                <div class="cartProductsBlockComment">
                                    <a class="cartProductsBlockCommentBacktomenu" href="/">Вернуться в меню</a>
                                </div>
                            </div>
                        <?php else: ?>
                            <p>Корзина пуста</p>
                            
                            <a class="btn btn-default checkout" href="/"><i class="fa fa-shopping-cart"></i> Вернуться к покупкам</a>
                        <?php endif; ?>

                    </div>
                    <div class="cartPaymentBlock">
                        <div class="cartPaymentBlockDesc">
                        <?php if ($productsInCart): ?>    
                            <span>Сумма заказа: <?php echo $totalPrice;?>р.</span>
                        <?php else: ?> 
                            <span>Нет товаров в корзине</span>   
                        <?php endif; ?>
                            <span>Стоимость доставки: бесплатно</span>
                            <span>номер скидочной карты</span>
                        </div>
                        <div class="cartPaymentBlockCartnumber">
                            <input type="text" id="cartPaymentBlockCartnumber1" maxlength="1" class="cartPaymentBlockCartnumberInput" value="">
                            <input type="text" id="cartPaymentBlockCartnumber2" maxlength="1" class="cartPaymentBlockCartnumberInput" value="">
                            <input type="text" id="cartPaymentBlockCartnumber3" maxlength="1" class="cartPaymentBlockCartnumberInput" value="">
                            <input type="text" id="cartPaymentBlockCartnumber4" maxlength="1" class="cartPaymentBlockCartnumberInput" value="">
                            <input type="text" id="cartPaymentBlockCartnumber5" maxlength="1" class="cartPaymentBlockCartnumberInput" value="">
                            <input type="text" id="cartPaymentBlockCartnumber6" maxlength="1" class="cartPaymentBlockCartnumberInput" value="">
                   <!--          <div id="contenInput">GO</div> -->
                        </div>
                        <div class="cartPaymentBlockItogo">
                        <?php if ($productsInCart): ?>
                            Итого: <span class="orderSumm"><?php echo $totalPrice;?></span> р.
                        <?php else: ?> 
                            <span>Нет товаров в корзине</span>      
                        <?php endif; ?>    
                        </div>
                        <div class="cartPaymentBlockMisc">
                            <!-- <span>В ваш заказ добавлено 2 бесплатных набора для суши.</span> -->
                            <span class="question">Нужны дополнительные наборы?</span>
                            <div class="cartPaymentBlockMiscRow">
                                <img class="cartPaymentBlockMiscImg" src="<?php echo Product::getImage($simpleProduct['id'])?>" alt="<?php echo $simpleProduct['name'] ?>" title="<?php echo $simpleProduct['name'] ?>" />
                                <div class="cartPaymentBlockMiscCost">
                                    <?php echo $simpleProduct['price']?> р.
                                </div>
                                <!-- <div ></div> -->
                                <a class="cartPaymentBlockMiscBuyButton" href="/cart/add/<?php echo $simpleProduct['id']; ?>" data-id="<?php echo $simpleProduct['id']; ?>" class="sushiBlockGetBusket add-to-cart">
                                    Купить
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="cartRow blackBackground">
                    <div class="cartPaymentRegistration">
                        <h2 class="headerContent">Оформление</h2>
                        <form id="cartRegistrationForm" class="cartRegistrationForm" action="">
                            <input type="text" class="registrationFormName" name="registrationFormName" placeholder="*Ваше имя" value="<?php echo $user['name'];?>" required>
                            <input type="text" class="registrationFormSurname" name="registrationFormSurname" placeholder="*Ваша Фамилия" value="<?php echo $user['surname'];?>"  required>
                            <input type="text" class="registrationFormPhone" name="registrationFormPhone" placeholder="*Телефон" value="<?php echo $user['phone'];?>" required>
                            <input type="text" class="registrationFormAdress" name="registrationFormAdress" placeholder="*Адрес" required>
                            <textarea name="registrationFormTextarea" id="registrationFormTextarea" cols="30" rows="3" placeholder="Добавить примечание к адресу"></textarea>
                        </form>
                    </div>
                    <div class="cartPaymentMethods">
                        <h2 class="headerContent">Способы оплаты</h2>
                            <div class="row">
                                <div class="cartPaymentMethodsBlock cartPaymentMethodsCache">Наличными курьеру</div>
                                <div class="cartPaymentMethodsBlock cartPaymentMethodsCart">Банковской картой</div>
                                <div class="cartPaymentMethodsBlock cartPaymentMethodsYandex">Яндекс деньги</div>
                            </div>
                            <div class="row">
                                <div class="cartPaymentMethodsBlock cartPaymentMethodsQiwi">Qiwi</div>
                                <div class="cartPaymentMethodsBlock cartPaymentMethodsWebmoney">Webmoney</div>
                                <div class="cartPaymentMethodsBlock cartPaymentMethodsCourercart">Картой курьеру</div>
                            </div>
                          <!--   <div class="row">
                                <div class="cartPaymentMethodsBlockSdacha ">С какой суммы требуется сдача ?</div>
                                <div class="cartPaymentMethodsBlockSdacha "><input type="text" id="cartPaymentMethodsSdachaInput" /></div>
                                <div class="cartPaymentMethodsBlockSdacha "><label for="cartPaymentMethodsSdachaCheckbox">Без сдачи</label><input type="checkbox" id="cartPaymentMethodsSdachaCheckbox" /></div>
                            </div> -->
                            <div class="row to-right" >
                                <div class="ContentDescPromoBlockTocart">
                                    <span>Заказать</span>
                                </div>
                            </div>
                    </div>
                </div>
                <h2 class="headerContent center">К вашему заказу предлагаем</h2>
                <div class="aditionallyWrap cartRow">
                    <!-- <img class="cartLeftArrow" src="template/images/icons/misc__leftArrow.svg"> -->
                    <div class="aditionallyBlocks cartRow">
                     <?php foreach ($randomProductsList as $product): ?>
                        <div class="sushiBlock sushiBlockSlider">
                            <img class="sushiBlockImage"  data-id="<?php echo $product['id']; ?>" src="<?php echo Product::getImage($product['id']); ?>" alt="<?php echo $product['name']; ?>">
                            <h2 class="sushiBlockHeader sushiopenProfail" data-id="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></h2>
                            <div class="sushiBlockDesc"><?php echo mb_strimwidth($product['description'], 0, 65, "..."); ?></div>
                            <div class="sushiBlockGet">
                                <div class="sushiBlockGetCost"><?php echo $product['price']; ?> р.</div>
                                <a href="/cart/add/<?php echo $product['id']; ?>" data-id="<?php echo $product['id']; ?>" class="sushiBlockGetBusket add-to-cart">
                                    В корзину
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>    
                    </div>
                    <!-- <img class="cartRightArrow" src="template/images/icons/misc__rightArrow.svg"> -->
                </div>
            </div>
        </div>
    </main>
    <div class="chooseProucts">
            <div class="sidebar">
                        <?php if ($productsInCart): ?>
                        <?php foreach ($products as $product): ?>    
                         <div class="cartRow">
                            <div class="cartRowDesc">
                                <span><?php echo $product['name'];?></span>
                            </div>
                            <div class="cartRowCost"><?php echo $product['price'];?> р.</div>
                            <input type="text" name="cartRowCount" class="cartRowCount cartProductsBlockInputcount" value="<?php echo $productsInCart[$product['id']];?>">
                            <div class="cartRowFinalCost"><?php echo $product['price']*$productsInCart[$product['id']];?> р.</div>
                            <div class="cartRowDelete">
                                <a href="/cart/delete/<?php echo $product['id'];?>">
                                    <img src="template/images/icons/misc__delete.svg" alt="">
                                </a>
                            </div>
                        </div> 
                        <?php endforeach; ?>
                        <?php else: ?>
                            <p>Корзина пуста</p>
                            
                            <a class="btn btn-default checkout" href="/"><i class="fa fa-shopping-cart"></i> Вернуться к покупкам</a>
                        <?php endif; ?>
                <div class="finalCost">
                    Итого: <?php echo $totalPrice;?> руб.
                </div>
                <form action="" class="formActionCart cartRegistrationForm" id="formActionCart">
                    <h3 class="formActionCartHeader">
                        Оформление
                    </h3>                     
                    <input type="text" class="formActionCartName registrationFormName" id="formActionCartName" name="registrationFormName" placeholder="*Ваше имя" value="<?php echo $user['name'];?>" required>
                    <input type="text" class="formActionCartSurname registrationFormSurname" id="formActionCartSurname" name="registrationFormSurname" placeholder="*Ваша фамилия" value="<?php echo $user['surname'];?>"  required>
                    <input type="text" class="formActionCartPhone registrationFormPhone" id="formActionCartPhone" name="registrationFormPhone" placeholder="*Телефон"value="<?php echo $user['phone'];?>" required>
                    <input type="text" class="formActionCartAdress registrationFormAdress" id="formActionCartAdress" name="registrationFormAdress" placeholder="*Адрес">
                    <textarea name="registrationFormTextarea" id="formActionCartComment" cols="30" rows="3" placeholder="Комментарий"></textarea>
                    <div class="formActionCartNext">
                        Далее >
                    </div>
                </form>
            </div>   
    </div>
    <div class="choosePayment">
            <div class="sidebar">
                <h3 class="choosePaymentHeader">Способы оплаты</h3>
                <div class="choosePaymentRow">
                    <div class="choosePaymentBlock choosePaymentBlockCache cartPaymentMethodsBlock">
                        Наличными<br>курьеру
                    </div>
                    <div class="choosePaymentBlock choosePaymentBlockYandexmoney cartPaymentMethodsBlock">
                        Яндекс<br>деньги
                    </div>
                </div>
                <div class="choosePaymentRow">
                    <div class="choosePaymentBlock choosePaymentBlockCourercart cartPaymentMethodsBlock">
                        Картой<br>курьеру
                    </div>
                    <div class="choosePaymentBlock choosePaymentBlockCart cartPaymentMethodsBlock">
                        Банковской<br>картой
                    </div>
                </div>
                <div class="choosePaymentRow">
                    <div class="choosePaymentBlock choosePaymentBlockQiwi cartPaymentMethodsBlock">
                        qiwi
                    </div>
                    <div class="choosePaymentBlock choosePaymentBlockWebmoney cartPaymentMethodsBlock">
                        webmoney
                    </div>
                </div>
                <!-- <div class="choosePaymentRow">
                    <div class="sdacha">
                        С какой суммы потребуется сдача ?
                    </div>
                    <input type="text" name="sdachaInput" class="sdachaInput" id="sdachaInput">
                </div>
                <div class="choosePaymentRow JustifyStart">
                    <label for="bezSdachi">Без сдачи</label>
                    <input type="checkbox" name="bezSdachi" class="bezSdachi" id="bezSdachi">
                </div> -->
                <div class="choosePaymentRow">
                <div class="formActionCartPrev">
                    < Назад
                </div>
                <div class="formActionCartZakaz ContentDescPromoBlockTocart">
                    <span>Заказать ></span>
                </div>
                </div>
            </div>  
    </div>
    <div class="sushiProfailWrapper">
        <div class="sushiProfailArea">
            <div class="closeModal">
                <img src="/template/images/icons/close.png" alt="Закрыть окно">
            </div>
            <h3></h3>
            <div class="tabs">
            <?php if (isset($product['is_combined'])) : ?>
              <ul class="tabs__caption">
                <li class="active">Маки</li>
                <li>Роял</li>
              </ul>
            <?php endif; ?>

              <div class="tabs__content active">
                <div class="tabs__contentDesc">
                    <img class="productModalImage" src="/template/images/user/sushi/profailImg.png" alt="">
                    <span class="productDescription"></span>
                </div>
                <div class="tabs__contentBuy">
                    <div class="row tabs__contentBuyBlock">
                        <img src="/template/images/icons/mainMenu__rolls.svg" alt="">
                        <span>*</span>
                        <span>4</span>
                        <span>=</span>
                        <span class="productPrice"><span class="min">р</span></span>
                        <input name="contentBuyItem" type="radio" checked/>
                    </div>
                    <span>Увеличить количество Вы сможете в корзине</span>
                    <div class="sushiBlockGetBusketProfail add-to-cart" data-id="">
                        В корзину
                    </div>
                </div>
              </div>

              <div class="tabs__content">
                <div class="tabs__contentDesc">
                    <img src="/template/images/user/sushi/profailImg.png" alt="">
                    <span>Лосось, сыр «Филадельфия», огурец (308 г)</span>
                    <span>Пищевая ценность:</span>
                    <span>Белки 21  Жиры 17  Углеводы 27  Калории 338</span>
                </div>
                <div class="tabs__contentBuy">
                    <div class="row tabs__contentBuyBlock">
                        <img src="/template/images/icons/mainMenu__rolls.svg" alt="">
                        <span>*</span>
                        <span>12</span>
                        <span>=</span>
                        <span>130<span class="min">р</span></span>
                        <input name="contentBuyItem" type="radio" checked/>
                    </div>
                    <div class="row tabs__contentBuyBlock">
                        <img src="/template/images/icons/mainMenu__rolls.svg" alt="">
                        <span>*</span>
                        <span>16</span>
                        <span>=</span>
                        <span>150<span class="min">р</span></span>
                        <input name="contentBuyItem" type="radio"/>
                    </div>
                    <div class="row tabs__contentBuyBlock">
                        <img src="/template/images/icons/mainMenu__rolls.svg" alt="">
                        <span>*</span>
                        <span>20</span>
                        <span>=</span>
                        <span>180<span class="min">р</span></span>
                        <input name="contentBuyItem" type="radio"/>
                    </div>
                    <span>Увеличить количество Вы сможете в корзине</span>
                    <div class="sushiBlockGetBusketProfail">
                        В корзину
                    </div>
                </div>
              </div>

            </div>
        </div>
    </div>
<?php include ROOT . '/views/layouts/footer.php'; ?>