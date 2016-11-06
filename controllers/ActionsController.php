<?php


/**
 * Контроллер ActionsController
 * Акции магазина
 */

class ActionsController
{

	/**
     * Action для страницы "Акции"
     */
    public function actionIndex()
    {

    	// Список категорий для левого меню
        $categories = Category::getCategoriesList();
    	
        // Список тематических блюд для левого меню
        $thematicCategories = Thematic::getThematicList();

         // Получим идентификаторы и количество товаров в корзине
        $productsInCart = Cart::getProducts();
        if ($productsInCart) {
            // Если в корзине есть товары, получаем полную информацию о товарах для списка
            // Получаем массив только с идентификаторами товаров
            $productsIds = array_keys($productsInCart);

            // Получаем массив с полной информацией о необходимых товарах
            $products = Product::getProdustsByIds($productsIds);

            // Получаем общую стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        } else {
            $totalPrice = "0";
        }

        // Получаем информацию о пользователе из БД
        $userId = User::getUser();
        $user = User::getUserById($userId);
        
        // Подключаем вид
        require_once(ROOT . '/views/actions/index.php');
        return true;
    }

    public function actionIndexInfo($id = 0)
    {
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Получаем инфомрацию о товаре
        $thematic = Thematic::getThematicById($id);

        // Список тематических блюд для левого меню
        $thematicCategories = Thematic::getThematicList();
        
        // Получим идентификаторы и количество товаров в корзине
        $productsInCart = Cart::getProducts();
        if ($productsInCart) {
            // Если в корзине есть товары, получаем полную информацию о товарах для списка
            // Получаем массив только с идентификаторами товаров
            $productsIds = array_keys($productsInCart);

            // Получаем массив с полной информацией о необходимых товарах
            $products = Product::getProdustsByIds($productsIds);

            // Получаем общую стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        } else {
            $totalPrice = "0";
        }

        // Получаем информацию о пользователе из БД
        $userId = User::getUser();
        $user = User::getUserById($userId);

        // Подключаем вид
        require_once(ROOT . '/views/actions/info.php');
        return $thematic;

    }

}