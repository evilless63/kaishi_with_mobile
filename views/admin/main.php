<?php include ROOT . '/views/layouts/header_admin.php'; ?>
<main class="main_board container">

        <h1 class="my my_g main_board_h1"><span>Заказы</span>
        <form action="?" class="app_form_search" id="app_form_search">
            <div class="my my_h"></div>
            <input type="text" name="app_search" id="app_search" class="app_search" placeholder="Введите № чека">
        </form>
        </h1>
        <div class="menu_main_board">
<!--         <ul>
                <li><a href="/admin/product">Управление товарами</a></li>
                <li><a href="/admin/category">Управление категориями</a></li>
                <li><a href="/admin/order">Управление заказами</a></li>
            </ul> -->
            <a id="all" class="menu_main_link" href="/admin/index">
                <div class="my my_a"></div>
                <div class="count_app"><?php echo $ordersAllCount["COUNT(*)"]; ?></div>
                <span>Все</span>
            </a>
            <a id="new" class="menu_main_link" href="/admin/orderlist/1">
                <div class="my my_b"></div>
                <div class="count_app"><?php echo $ordersNewCount["COUNT(*)"]; ?></div>
                <span>Новые</span>
            </a>
            <a id="accepted" class="menu_main_link" href="/admin/orderlist/2">
                <div class="my my_c"></div>
                <div class="count_app"><?php echo $ordersAcceptedCount["COUNT(*)"]; ?></div>
                <span>Принятые</span>
            </a>
            <a id="on_way" class="menu_main_link" href="/admin/orderlist/3">
                <div class="my my_d"></div>
                <div class="count_app"><?php echo $ordersOnwayCount["COUNT(*)"]; ?></div>
                <span>В пути</span>
            </a>
            <a id="completed" class="menu_main_link" href="/admin/orderlist/4">
                <div class="my my_e"></div>
                <div class="count_app"><?php echo $ordersFinishedCount["COUNT(*)"]; ?></div>
                <span>Завершенные</span>
            </a>
            <a id="deleted" class="menu_main_link" href="/admin/orderlist/5">
                <div class="my my_f"></div>
                <div class="count_app"><?php echo $ordersDeletedCount["COUNT(*)"]; ?></div>
                <span>Удаленные</span>
            </a>
        </div>
        <table class="application_field">
            <thead class="application_field_header">
                <tr>
                    <td class="app_number">№</td>
                    <td class="app_phone">Телефон</td>
                    <td class="app_adress">Адрес</td>
                    <td class="app_time">Время</td>
                    <td class="app_status">Статус</td>
                </tr>
            </thead>
            <tbody class="application_field_body">
                <?php foreach ($ordersList as $order): ?>
                    <tr>
                        <td class="app_body_number"><?php echo $order['user_ordernumber']; ?></td>
                        <td class="app_body_phone"><?php echo $order['user_phone']; ?></td>
                        <td class="app_body_adress"><a href="/admin/order/view/<?php echo $order['id']; ?>">
                            <?php echo $order['user_adress']; ?>
                        </a></td>
                        <td class="app_body_time"><?php echo $order['date']; ?></td>
                        <?php echo Order::getStatusText($order['user_orderstatus']); ?>
                    </tr>
                <?php endforeach; ?>
                <tr class="app_whitespace_field_body">
                    <td></td>
                    <td></td>
                    <td class="app_body_adress"></td>
                    <td></td>
                    <td class="app_status_onway"></td>
                </tr>
            </tbody>
        </table>
    </main>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

