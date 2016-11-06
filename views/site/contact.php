<?php include ROOT . '/views/layouts/header.php'; ?>

<main>
    <div class="mainWrap mainWrapContacts container row toSpaceBetween">
        <div class="content contentContacts contactsContent">
            <h1 class="contactsContentHeader">Контакты</h1>
            <div class="contactsContentRow">
                <div class="contactsContentBlock">
                    <img class="contactsContentBlockImg" src="/template/images/icons/contacts__phone.svg" alt="">
                    <span>(846) 2030-454</span>
                    <span>(846) 2030-454</span>
                </div>
                <div class="contactsContentBlock">
                    <img class="contactsContentBlockImg" src="/template/images/icons/contacts__gps.svg" alt="">
                    <span>192174, Самара, ул. Аврора </span>
                    <span>192174, Самара, ул. Аврора </span>
                </div>
                <div class="contactsContentBlock">
                    <img class="contactsContentBlockImg" src="/template/images/icons/contacts__time.svg" alt="">
                    <span>ПН-ПТ. 9:00-00.00</span>
                </div>
            </div>
            <div class="contactsContentMap">
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=A722jlUaefj4pUPcPOsmLNMSHJXCNHDs&width=922&height=510&lang=ru_RU&sourceType=constructor&scroll=true"></script>
            </div>
        </div>
    </div>
</main>

<?php include ROOT . '/views/layouts/footer.php'; ?>