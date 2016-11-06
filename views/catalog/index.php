<?php include ROOT . '/views/layouts/header.php'; ?>
<main>
        <div class="mainWrap container row toSpaceBetween">
            <?php include ROOT . '/views/layouts/sidebar.php'; ?>
            <div class="content contentMainPage">
                <div class="saleBanner">
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
                    <img src="images/user/mainBanner.jpg" alt="25% СКИДКА НА ВСЕ РОЛЛЫ">
                </div>
                <div class="newProducts row">
                    <div class="areaBig">
                        <div class="areaBigTriangle">
                            <div class="areaBigText">
                                <div class="areaBigHeader">Пицца дьябло</div>
                                <div class="areaBigSubHeader">Пицца месяца</div>
                                <div class="areaBigCost">330 <span>р.</span></div>
                            </div>
                        </div>
                        <img src="images/user/newProductBig.jpg" alt="">
                    </div>
                    <div class="areaSmall">
                        <div class="areaSmallTriangle">
                            <div class="areaSmallText">
                                <div class="areaSmallHeader">Ролл креветка </div>
                                <div class="areaSmallDesc">водоросли Нори, спайси соус, кунжут жареный</div>
                            </div>
                        </div>
                        <img src="images/user/newProductSmall.jpg" alt="">
                    </div>
                </div>
                <div class="thematic">
                    <div class="thematicWrapper">
                        <div class="thematicHeader">Лучший выбор</div>
                        <div class="thematicSubHeader">Для романтического ужина</div>
                    </div>
                    <img src="images/user/thematicImg.jpg" alt="">
                </div>
            </div>
        </div>
    </main>

<?php include ROOT . '/views/layouts/footer.php'; ?>