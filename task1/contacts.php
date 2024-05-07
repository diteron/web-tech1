<?php
    $title = "Контакты";
    include "templates/header.php";
?>

<div class="main-container">
    <main>
        <div class="contacts-container">
            <div class="contacts-text">
                <h3>г. Минск, ул. Гурского, 20</h3>
                <p>Понедельник-пятница с 8:00 до 18:00</p>
                <p>тел.: <a href="tel:#">+375 (29) 724-42-42</a></p>
                <p>email: <a href="#">automaster_m@gmail.com</a></p>
                <p class="taxpayer-num">УНП 190021234</p>
            </div>
            <div class="map">
                <div class="iframe-container">
                    <iframe
                        src="https://yandex.ru/map-widget/v1/?um=constructor%3Af5e13ad02f963386ae79c0db1e7ca63ac80ca6da66c300c21915b98abad3d23f&amp;source=constructor"></iframe>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include "templates/footer.php"; ?>
