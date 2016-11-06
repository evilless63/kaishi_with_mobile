<?php include ROOT . '/views/layouts/header_admin.php'; ?>
        <form action="?" class="person_card" id="person_card">
            <input type="text" class="person_card_phone" id="person_card_phone" name="person_card_phone" data-validation="number" placeholder="+7 (917) 456-45-69" value="<?php echo $order['user_phone']; ?>">
            <input type="text" class="person_card_adress" id="person_card_adress" name="person_card_adress" placeholder="ул.Аврора, д. 70 , пд. 1, кв. 96" value="<?php echo $order['user_adress']; ?>">
            <input type="text" class="person_card_name" id="person_card_name" name="person_card_name" placeholder="Наталья Руденко" value="<?php echo $order['user_name']; ?>">
            <input type="text" class="person_card_number" id="person_card_number" name="person_card_number" placeholder="445625">
            <label for="person_card_number">&nbsp;</label>
            <div class="person_card_submit" id="person_card_submit" >Изменить</div>
            <input type="hidden" class="order_id" id="order_id" name="order_id" value="<?php echo $order['id']; ?>" >
            <input type="hidden" name="user_orderstatus" class="user_orderstatus"  value="<?php echo $order['user_orderstatus']; ?>">
        </form>
        <table class="cur_application">
            <thead class="cur_application_head">
                <tr>
                    <td class="cur_application_number_head">№</td>
                    <td class="cur_application_product_head">Товар</td>
                    <td class="cur_application_count_head">Кол-во</td>
                    <td class="cur_application_change_count_head">Изменить кол-во</td>
                    <td class="cur_application_delete_count_head">Удалить</td>
                    <td class="cur_application_cost_head">Стоимость</td>
                    <td class="cur_application_summ_head">Сумма</td>
                </tr>
            </thead>
            <tbody class="cur_application_body">
                <?php 
                $curNumber = 1;
                foreach ($products as $product): 
                    ?>
                    <tr class="productContaner">
                        <input type="hidden" class="get_product_id" value="<?php echo $product['id']; ?>" />
                        <td class="cur_application_number_body"><?php echo $curNumber?></td>
                        <td class="cur_application_product_body"><?php echo $product['name']; ?></td>
                        <td class="cur_application_count_body"><?php echo $productsQuantity[$product['id']]; ?></td>
                        <td class="cur_application_change_count_body">
                            <div class="my my_q countPlus"></div>
                            <div class="my my_r countMinus"></div>
                        </td>
                        <td class="cur_application_delete_count_body">
                            <div class="my my_s deleteCurrentPosition"></div>
                        </td>
                        <td class="cur_application_cost_body"><?php echo $product['price']; ?></td>
                        <td class="cur_application_summ_body"></td>
                    </tr>
                <?php 

                $curNumber ++;
                endforeach; 
                ?>
                <tr class="cur_application_body_add_product">
                    <td class="cur_application_number_body"></td>
                    <td class="cur_application_product_body">Добавить позицию
                        <div class="addProductWindow">
                            <ul>
                            <?php 
                            foreach ($categories as $categoryItem): ?>
                                <li class="catalogType" hasid="<?php echo $categoryItem['id']; ?>">
                                    <?php echo $categoryItem['name']; ?>
                                    <div></div>
                                </li>
                            <?php 
                            endforeach; ?>   
                            </ul>
                        </div>
                    </td>
                    <td class="cur_application_count_body"></td>
                    <td class="cur_application_change_count_body">
                    </td>
                    <td class="cur_application_delete_count_body">
                    </td>
                    <td class="cur_application_cost_body"></td>
                    <td class="cur_application_summ_body_add"></td>
                </tr>
            </tbody>
        </table>
        <form action="?" class="comment_and_summ_block">
            <div class="comments">
                <label for="comments">Комментарии</label>
                <textarea id="comments_textarea" name="comments_textarea" class="comments_textarea"><?php echo $order['user_comment']; ?></textarea>
            </div>
            <div class="all_summ">
                <label for="all_summ_textarea">Скидка по № 445625 15%(730-15%)</label>
                <div class="all_summ_textarea">
                    Итого: <span class="wholeSumm"><?php echo $order['order_summ']; ?></span> руб.
                </div>
            </div>
        </form>
        <ul class="app_manage_buttons">
            <li><div class="app_button_accepted button_status" status="2">Принято</div></li>
            <li><div class="app_button_ready button_status" status="3" >Готово</div></li>
            <li><div class="app_button_check_num button_status">№ Чека</div></li>
            <li><div class="app_button_onway button_status" status="4" >В пути</div></li>
            <li><div class="app_button_delivered button_status" status="5" >Доставлено</div></li>
            <li><div class="app_button_delete button_status" status="6">Удалить</div></li>
        </ul>
        <div class="getAdminCommentDelete"><?php echo $order['del_comment']; ?></div>
    </main>
    <div id="trigg"></div>
    <div class="addProductWrapper"></div>
    <div class="admin_delete_background"></div>
<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

