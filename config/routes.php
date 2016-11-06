<?php

return array(
    // Товар:
    'product/([0-9]+)' => 'product/view/$1', // actionView в ProductController
    // Каталог:
    'catalog' => 'catalog/index', // actionIndex в CatalogController
    // Категория товаров:
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory в CatalogController   
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory в CatalogController
    //Тематический ужин
    'thematic' => 'thematic/index', // actionIndex в ThematicContoller
    'thematicItem/([0-9]+)' => 'thematic/item/$1', // actionView в ThematicContoller
    //Акции
    'actions' => 'actions/index', // actionIndex в ActionContoller
    'actionsInfo' => 'actions/Info/', // actionInfo в ActionContoller
    // Корзина:
    'cart/checkout' => 'cart/checkout', // actionAdd в CartController    
    'cart/Addproducts' => 'cart/Addproducts', // Addproducts в CartController   
    'cart/delete/([0-9]+)' => 'cart/delete/$1', // actionDelete в CartController    
    'cart/plus/([0-9]+)' => 'cart/plus/$1', // actionDelete в CartController 
    'cart/minus/([0-9]+)' => 'cart/minus/$1', // actionDelete в CartController 
    'cart/add/([0-9]+)' => 'cart/add/$1', // actionAdd в CartController    
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', // actionAddAjax в CartController
    'cart' => 'cart/index', // actionIndex в CartController
    // Пользователь:
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/loginbyphone' => 'user/loginbyphone',
    'user/logout' => 'user/logout',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    'cabinet/addfeedback' => 'cabinet/addfeedback',
    // Управление товарами:    
    'admin/product/create' => 'adminProduct/create',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',
    // Управление категориями:    
    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',
    // Управление заказами:    
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/orderlist/([0-9]+)' => 'adminOrder/orderlist/$1',
    'adminOrder/getcategory/([0-9]+)' => 'adminOrder/getcategory/$1',
    'admin/getorderbynumber/([0-9]+)' => 'adminOrder/getorderbynumber/$1',
    'admin/order' => 'adminOrder/index',
    // Админпанель:
    'admin/index' => 'admin/index',
    'admin' => 'admin/main',
    // О магазине
    'delivery' => 'site/delivery',
    'shares' => 'site/shares',
    'contacts' => 'site/contacts',
    'news' => 'site/news',
    'reviews' => 'site/reviews',
    'vacancies' => 'site/vacancies',
    'about' => 'site/about',
    // Главная страница
    'index.php' => 'site/index', // actionIndex в SiteController
    '' => 'site/index', // actionIndex в SiteController
);
