<?php

/**
 * Контроллер CartController
 * Корзина
 */
class CartController
{

    /**
     * Action для добавления товара в корзину синхронным запросом<br/>
     * (для примера, не используется)
     * @param integer $id <p>id товара</p>
     */
    public function actionAdd($id)
    {
        // Добавляем товар в корзину
        Cart::addProduct($id);

        // Возвращаем пользователя на страницу с которой он пришел
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

    /**
     * Action для добавления товара в корзину при помощи асинхронного запроса (ajax)
     * @param integer $id <p>id товара</p>
     */
    public function actionAddAjax($id)
    {
        // Добавляем товар в корзину и печатаем результат: количество товаров в корзине
        echo Cart::addProduct($id);
        return true;
    }
    
    /**
     * Action для добавления товара в корзину синхронным запросом
     * @param integer $id <p>id товара</p>
     */
    public function actionDelete($id)
    {
        // Удаляем заданный товар из корзины
        Cart::deleteProduct($id);

        // Возвращаем пользователя в корзину
        header("Location: /cart");
    }

    public function actionPlus($id)
    {
        // Удаляем заданный товар из корзины
        Cart::plusProduct($id);

        // Возвращаем пользователя в корзину
        header("Location: /cart");
    }

    public function actionMinus($id)
    {
        // Удаляем заданный товар из корзины
        Cart::minusProduct($id);

        // Возвращаем пользователя в корзину
        header("Location: /cart");
    }


    /**
     * Action для страницы "Корзина"
     */
    public function actionIndex()
    {
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();
        
        // Получим идентификаторы и количество товаров в корзине
        $productsInCart = Cart::getProducts();

        $productCount = Product::getProductCount();

        //Получаем рандомный товар 1
        $productCountOne = rand(0, $productCount);
        $simpleProduct = Product::getRandomProduct($productCountOne);

        //Получаем перечень рандомных товаров
        // $randomCounts = array();
        // for($i=0 ; $i<12 ; $i++) {
        //     $randomCounts[$i] = $productCountOne; 
        //     $productCountOne++;      
        // } 

        $randomProductsList = Product::getLatestProducts(12);
        
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
        require_once(ROOT . '/views/cart/index.php');
        return true;
       
    }

    public function actionGetcashcard(){

        if(isset($_POST['getCashCard'], $totalPrice)) {

            $value = $_POST['cartPaymentBlockCartnumber1'].$_POST['cartPaymentBlockCartnumber2'].$_POST['cartPaymentBlockCartnumber3'].$_POST['cartPaymentBlockCartnumber4'].$_POST['cartPaymentBlockCartnumber5'].$_POST['cartPaymentBlockCartnumber6'];

            $thisCard = Order::getCashCard($value); 
            if($thisCard) {
                $totalPriceSale = $totalPrice/$thisCard['sale_count'];
                $totalPrice = $totalPrice - $totalPriceSale;

                echo $totalPrice;
            } else {
                echo "Ваша карта не активна либо вы неверно ввели ее номер, повторите, пожалуйста, заново !";
            }
            
        }

    }


    public function actionAddproducts()
    {

        $productsInCart = Cart::getProducts();
        $result = false;

        if(isset($_POST['goOrder'])) {

                // Обработка формы
                // Если форма отправлена
                // Получаем данные из формы
                $userName = $_POST['userName'];
                $userSurname = $_POST['userSurname'];
                $userAdress = $_POST['userAdress'];
                $userPhone = $_POST['userPhone'];
                $userComment = $_POST['userComment'];
                $userAdressDop = $_POST['userAdressDop'];
                $userPayMethod = $_POST['userPayMethod'];
                $orderSumm = $_POST['orderSumm'];
                $userId = $_SESSION['user'];
                $orderStatus = 1;

                if(isset($userName, $userSurname, $userAdress, $userPhone, $userPayMethod)) {
                   // Если ошибок нет
                // Сохраняем заказ в базе данных
                $currentOrderNumber = Order::selectMaxOrderNumber();
                $orderNumber = $currentOrderNumber['user_ordernumber'];
                $orderNumber ++;
                $result = Order::save($userName, $userId, $userSurname, $userAdress, $userPhone, $userComment, $userAdressDop, $productsInCart, $userPayMethod, $orderNumber, $orderStatus, $orderSumm);
                // echo "Ваш заказ №" . $orderNumber . "успешно сохранен";

                    if ($result) {
                        // Если заказ успешно сохранен
                        // Оповещаем администратора о новом заказе по почте                
                        $adminEmail = 'vitaliy030589@gmail.com';
                        $message = '<a href="http://kaishi/admin/orders">Список заказов</a>';
                        $subject = 'Новый заказ!';
                        mail($adminEmail, $subject, $message);

                        // Очищаем корзину
                        Cart::clear();
                    } 
                }  
            }

    }

    /**
     * Action для страницы "Оформление покупки"
     */
    public function actionCheckout()
    {
        // Получием данные из корзины      
        $productsInCart = Cart::getProducts();

        // Если товаров нет, отправляем пользователи искать товары на главную
        if ($productsInCart == false) {
            header("Location: /");
        }

        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Находим общую стоимость
        $productsIds = array_keys($productsInCart);
        $products = Product::getProdustsByIds($productsIds);
        $totalPrice = Cart::getTotalPrice($products);

        // Количество товаров
        $totalQuantity = Cart::countItems();

        // Поля для формы
        // $userName = false;
        // $userPhone = false;
        // $userComment = false;

        // Статус успешного оформления заказа
        $result = false;

        // Проверяем является ли пользователь гостем
        if (!User::isGuest()) {
            // Если пользователь не гость
            // Получаем информацию о пользователе из БД
            $userId = User::checkLogged();
            $user = User::getUserById($userId);
            $userName = $user['name'];
        } else {
            // Если гость, поля формы останутся пустыми
            $userId = false;
        }

        
        

        // // Подключаем вид
        // require_once(ROOT . '/views/cart/checkout.php');
        // return true;

         
    }

}
