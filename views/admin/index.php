<?php include ROOT . '/views/layouts/header_admin.php'; ?>
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
                <?php foreach ($ordersList as $order): 
                    if ($order['user_orderstatus'] == "6"):?>
                <?php else: ?>
                    <tr data-href="/admin/order/view/<?php echo $order['id']; ?>">
                        <td class="app_body_number"><?php echo $order['user_ordernumber']; ?></td>
                        <td class="app_body_phone"><?php echo $order['user_phone']; ?></td>
                        <td class="app_body_adress"><?php echo $order['user_adress']; ?></td>
                        <td class="app_body_time"><?php echo $order['date']; ?></td>
                        <?php echo Order::getStatusText($order['user_orderstatus']); ?>
                    </tr>
                <?php endif;?>    
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

