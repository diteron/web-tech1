<?php
    $title = "FAQ";
    include "templates/header.php";
?>

<div class="main-container">
    <main>
        <div class="faq-description">
            <h2>Часто задаваемые вопросы (FAQ)</h2>
            <p>На этой странице мы собрали ответы на самые распространенные вопросы, которые у нас часто задают клиенты. Если у вас
                остались какие-либо вопросы, не указанные здесь, не стесняйтесь связаться с нашей командой, и мы с удовольствием вам
                поможем.</p>
        </div>
        <div class="question-answers">
            <div class="question-answer">
                <h3>1. Сколько времени занимает замена масла и фильтров?</h3>
                <p>Обычно процесс замены масла и фильтров занимает примерно 30-60 минут, в зависимости от модели вашего автомобиля и
                    текущего загруженности нашей станции. Мы стремимся выполнить эту работу как можно быстрее, чтобы вы могли вернуться на
                    дорогу как можно скорее.</p>
            </div>
            <div class="question-answer">
                <h3>2. Насколько часто рекомендуется проводить развал-схождение и балансировку колес?</h3>
                <p>Обычно рекомендуется проводить развал-схождение и балансировку колес при каждой замене шин или при первых признаках
                    вибрации или неровности во время езды. Это поможет предотвратить износ шин и обеспечить комфортное и безопасное
                    вождение.</p>
            </div>
            <div class="question-answer">
                <h3>3. Как часто следует проводить диагностику автомобиля?</h3>
                <p>Мы рекомендуем проводить компьютерную диагностику автомобиля при каждом плановом техническом обслуживании или при
                    появлении любых признаков неисправностей, таких как загорание индикаторов на приборной панели или аномальные звуки или
                    вибрации. Это поможет выявить проблемы на ранней стадии и предотвратить более серьезные поломки.</p>
            </div>
            <div class="question-answer">
                <h3>4. Как происходит беспокрасочное удаление вмятин?</h3>
                <p>Беспокрасочное удаление вмятин - это процесс, при котором специализированные инструменты используются для вытягивания
                    вмятин, не повреждая лакокрасочное покрытие. Этот метод идеально подходит для небольших вмятин, таких как
                    вмятины от града или парковки.</p>
            </div>
            <div class="question-answer">
                <h3>5. Какой срок гарантии на выполненные работы?</h3>
                <p>АвтоМастер предоставляет гарантию сроком 2 года или 20 000 км на текущий ремонт ходовой части автомобиля,
                    сцепления, двигателя, замену ремней ГРМ и другие работы.</p>
            </div>
        </div>
        <div class="feedback-form">
            <h3 class="description">Если у вас есть еще вопросы, вы можете задать их используя следующую форму и мы вам перезвоним.</h3>
            <form action="faq.php" method="POST">
                <div class="form-fields">
                    <label for="name">Имя*:</label><br>
                    <input type="text" id="name" required><br>
                    <label for="tel-number">Номер телефона*:</label><br>
                    <input type="tel" id="tel-number" placeholder="+375 (xx) xxx-xx-xx" required><br>
                    <label for="question">Вопрос*:</label><br>
                    <textarea type="text" id="question" rows="5" cols="80" required></textarea><br>
                </div>
                <input class="send-button" type="submit" value="Отправить">
            </form>
        </div>
    </main>
</div>

<?php include "templates/footer.php"; ?>