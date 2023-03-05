<form method="post">
    <h1>Форма обратной связи</h1>
    <div>
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="message">Сообщение:</label>
        <textarea id="message" name="message" required></textarea>
    </div>
    <button type="submit" >Отправить</button>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
        echo "<script>alert('Данные успешно отправлены!');</script>";
    }
    ?>

</form>