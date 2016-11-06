<?php include ROOT . '/views/layouts/header.php'; ?>

<main>
        <div class="mainWrap container row toSpaceBetween">
            <?php include ROOT . '/views/layouts/sidebar.php'; ?>
            <div class="content contentMainPage">
                <div class="saleBanner">
                    <a class="linkFromMainPage" href="/actions">
                        <div class="saleBannerCircle">
                            <div class="saleBannerCircleHeader">
                                25% скидка на все роллы
                            </div>
                            <div class="saleBannerCircleSubHeader">
                                Каждый понедельник
                            </div>
                            <div class="saleBannerCircleLine"></div>
                            <div class="saleBannerCircleSubHeader">
                                Скидка 10% на все предзаказы. (Заказы ко времени)
                            </div>
                            <div class="saleBannerCircleSub">
                                Предложение действует на заказы от 700 рублей.
                            </div>
                        </div>
                        <img src="/template/images/user/mainBanner.jpg" alt="25% СКИДКА НА ВСЕ РОЛЛЫ">
                    </a>
                </div>
                <div class="newProducts row">
                    <div class="areaBig">
                        <a class="linkFromMainPage" href="/category/8">
                            <div class="areaBigTriangle">
                                <div class="areaBigText">
                                    <div class="areaBigHeader">Пицца дьябло</div>
                                    <div class="areaBigSubHeader">Пицца месяца</div>
                                    <div class="areaBigCost">330 <span>р.</span></div>
                                </div>
                            </div>
                            <img src="/template/images/user/newProductBig.jpg" alt="">
                        </a>
                    </div>
                    <div class="areaSmall">
                        <a class="linkFromMainPage" href="/category/3">
                            <div class="areaSmallTriangle">
                                <div class="areaSmallText">
                                    <div class="areaSmallHeader">Ролл креветка </div>
                                    <div class="areaSmallDesc">водоросли Нори, спайси соус, кунжут жареный</div>
                                </div>
                            </div>
                            <img src="/template/images/user/newProductSmall.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="thematic">
                    <a class="linkFromMainPage" href="/thematicItem/1">
                        <div class="thematicWrapper">
                            <div class="thematicHeader">Лучший выбор</div>
                            <div class="thematicSubHeader">Для романтического ужина</div>
                        </div>
                        <img src="/template/images/user/thematicImg.jpg" alt="">
                    </a>    
                </div>
            </div>
        </div>
       </div> 
    </main>
    <div class="indexMobile">
        <div class="mainWrap container row toSpaceBetween">
            <div class="sidebar">
                <div class="productMenu">
                    <ul>
                        <?php 
                        $arrayAclass = array('sushi', 'inari', 'rolls', 'hotrolls', 'set', 'gunkan', 'zakuski', 'pizza', 'drink');
                        $count = 0;
                        foreach ($categories as $categoryItem): ?>
                        <li>
                            <a class="<?php echo $arrayAclass[$count]; ?>" href="/category/<?php echo $categoryItem['id']; ?>"
                             class="<?php if ($categoryId == $categoryItem['id']) echo 'catalogActive'; ?>">                                                                                    
                             <?php echo $categoryItem['name']; ?>
                         </a>
                     </li>
                     <?php 
                     $count++ ;   
                     endforeach; ?>   
                 </ul>
             </div>
         </div>
     </div>  
 </div>
<?php include ROOT . '/views/layouts/footer.php'; ?>