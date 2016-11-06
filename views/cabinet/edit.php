<?php include ROOT . '/views/layouts/header.php'; ?>

    <main>
        <div class="mainWrapLC container row toSpaceBetween">
            <div class="content lcContent">
                <?php if ($result): ?>
                    <p>Данные отредактированы!</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                        <h1 class="lcContentHeader">Редактирование данных</h1>
                        <form action="#" method="post" class="lcContentTabs">
                            <div class="zakaz redactData">
                                <div class="settingsRow">
                                    <div class="settingsEdit">Имя:</div>
                                    <input type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>"/>
                                </div>
                                <div class="settingsRow">
                                    <div class="settingsEdit">Фамилия:</div>
                                    <input type="text" name="surname" placeholder="Фамилия" value="<?php echo $surname; ?>"/>
                                </div>
                                <div class="settingsRow">
                                    <div class="settingsEdit">Логин:</div>
                                    <input type="text" name="login" placeholder="Логин" value="<?php echo $login; ?>"/>
                                </div>
                                <div class="settingsRow">
                                    <div class="settingsEdit">Телефон:</div>
                                    <input type="text" name="phone" placeholder="Телефон" value="<?php echo $phone; ?>"/>
                                </div>
                                <div class="settingsRow">
                                    <div class="settingsEdit">Email:</div>
                                    <input type="text" name="email" placeholder="Email" value="<?php echo $email; ?>"/>
                                </div>
                                <div class="settingsRow">
                                    <div class="settingsEdit">Пароль:</div>
                                    <input type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/>
                                </div>
                                <div class="row">
                                    <input type="submit" name="submit" class="passwordEdit" value="Сохранить" />
                                    <a class="passwordEdit" href="/cabinet">Вернуться</a>
                                </div>
                            </div>
                        </form>
                    </div><!--/sign up form-->
                
                <?php endif; ?>
            </div>
        </div>
    </main>

<?php include ROOT . '/views/layouts/footer.php'; ?>