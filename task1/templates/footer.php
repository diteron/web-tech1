<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location: /error.php'));
}
?>

<div class="footer-container">
    <footer>
        <div class="copyright">
            <p>© АвтоМастер</p>
        </div>
        <div class="company-info">
            <h1 class="logo">Авто<span style="color: #d8b74c;">Мастер</span></h1>
            <div class="info">
                <p>г. Минск, ул. Гурского, 20</p>
                <p>Понедельник-пятница: 8:00-18:00</p>
                <p>тел.: +375 (29) 724-42-42</p>
            </div>
        </div>
    </footer>
</div>

</body>

</html>