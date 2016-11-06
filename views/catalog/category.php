<?php include ROOT . '/views/layouts/header.php'; ?>
<main>
        <div class="mainWrap container row toSpaceBetween">
            <?php include ROOT . '/views/layouts/sidebar.php'; ?>
            <div class="catalogContent">
                <h1 class="headerContent"><?php echo $categoryName['name']; ?></h1>
                <div class="Content">
                    <div class="row sushiRow sushiCatalogRow">
                     <?php 
                     $countProducts = 0;

                     foreach ($categoryProducts as $product): ?>
                        <div class="sushiBlock">
                            <img class="sushiBlockImage" data-id="<?php echo $product['id']; ?>" src="<?php echo Product::getImage($product['id']); ?>" alt="Суши">
                            <h2 class="sushiBlockHeader sushiopenProfail" data-id="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></h2>
                            <div class="sushiBlockDesc"><?php echo mb_strimwidth($product['description'], 0, 65, "..."); ?></div>
                            <div class="sushiBlockGet">
                                <div class="sushiBlockGetCost"><?php echo $product['price']; ?> р.</div>
                                <a href="/cart/add/<?php echo $product['id']; ?>" data-id="<?php echo $product['id']; ?>" class="sushiBlockGetBusket add-to-cart">
                                    В корзину
                                </a>
                                <!-- <?php if ($product['is_new']): ?>
                                        <img src="/template/images/home/new.png" class="new" alt="" />
                                <?php endif; ?> -->
                            </div>
                        </div>
                     <?php   
                        $countProducts ++;
                        if ($countProducts >= 4) { 
                            $countProducts = 0;?>  
                            </div>
                            <div class="row sushiRow sushiCatalogRow">
                        <?php }
                      endforeach; ?>
                </div>
            </div>
        </div>
       </div> 
       <!-- Постраничная навигация -->
       <!-- <?php echo $pagination->get(); ?> -->
    </main>
    <div class="catalogMobile">
        <div class="mainWrap container row toSpaceBetween">
            <div class="sidebar">
            <?php foreach ($categoryProducts as $product): ?>
                <div class="rowProduct">
                    <div class="rowProductHeader"><?php echo $product['name']; ?></div>
                    <img class="rowProductImg" data-id="<?php echo $product['id']; ?>" src="<?php echo Product::getImage($product['id']); ?>" alt="<?php echo $product['name']; ?>">
                    <div class="rowProductDesc"><?php echo mb_strimwidth($product['description'], 0, 65, "..."); ?></div>
                    <div class="rowProductPayment">
                        <div class="rowProductPaymentCost"><?php echo $product['price']; ?> р.</div>
                        <div class="rowProductPaymentTocart">
                            В корзину
                        </div>
                    </div>
                </div>
             <?php endforeach; ?>
            </div>
         </div> 
    </div>
    <div class="sushiProfailWrapper sushiProfailWrapperDesktop">
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
                       
                        <!-- <input name="contentBuyItem" type="radio" checked/> -->
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
    <div class="sushiProfailWrapper sushiProfailWrapperMobile">
        <div class="sushiProfailArea">
            <h3>Филадельфия</h3>
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
                       
                        <!-- <input name="contentBuyItem" type="radio" checked/> -->
                    </div>
                    <span>Увеличить количество Вы сможете в корзине</span>
                    <div class="sushiBlockToCatalog">
                        Продолжить выбор<span> ></span>
                    </div>
                    <div class="sushiBlockGetBusketProfail add-to-cart" data-id="">
                        В корзину
                    </div>
                </div>
              </div>

              <div class="tabs__content">
                <div class="tabs__contentBuy">
                <span>Лосось, сыр «Филадельфия», огурец (308 г)</span>
                    <div class="row tabs__contentBuyBlock">
                        <img src="/template/images/icons/mainMenu__rolls.svg" alt="">
                        <span>*</span>
                        <span>4</span>
                        <span>=</span>
                        <span>130<span class="min">р</span></span>
                        <input name="contentBuyItem" type="radio" checked/>
                    </div>
                    <div class="row tabs__contentBuyBlock">
                        <img src="/template/images/icons/mainMenu__rolls.svg" alt="">
                        <span>*</span>
                        <span>6</span>
                        <span>=</span>
                        <span>150<span class="min">р</span></span>
                        <input name="contentBuyItem" type="radio"/>
                    </div>
                    <div class="row tabs__contentBuyBlock">
                        <img src="/template/images/icons/mainMenu__rolls.svg" alt="">
                        <span>*</span>
                        <span>8</span>
                        <span>=</span>
                        <span>180<span class="min">р</span></span>
                        <input name="contentBuyItem" type="radio"/>
                    </div>
                    <span>Пищевая ценность:</span>
                    <span>Белки 21  Жиры 17  Углеводы 27  Калории 338</span>
                    <div class="sushiBlockToCatalog">
                        Продолжить выбор<span> ></span>
                    </div>
                    <div class="sushiBlockGetBusketProfail">
                        Оформить заказ
                    </div>
                </div>
              </div>

            </div>
        </div>
    </div>
<?php include ROOT . '/views/layouts/footer.php'; ?>