<form id="app" @submit="checkForm" method="post">
    <h1>Форма обратной связи</h1>
    <p v-if="errors.length">
        <b>Пожалуйста исправьте указанные ошибки:</b>
    <ul>
        <li v-for="error in errors">{{ error }}</li>
    </ul>
    </p>
    <div>
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" v-model="name" >
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" v-model="email" >
    </div>
    <div>
        <label for="message">Сообщение:</label>
        <textarea id="message" name="message" v-model="message" ></textarea>
    </div>
    <button type="submit" >Отправить</button>

    <?php
    require_once "vendor/phpmailer/phpmailer/src/PHPMailer.php";
    require_once "vendor/phpmailer/phpmailer/src/SMTP.php";
    require_once "vendor/phpmailer/phpmailer/src/Exception.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $message = $_POST['message'] ?? '';

        $errors = [];
        if (empty($name)) {
            $errors[] = 'Введите имя';
        }
        if (empty($email)) {
            $errors[] = 'Введите email';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Введите корректный email';
        }
        if (empty($message)) {
            $errors[] = 'Введите сообщение';
        }
        if (empty($errors)) {
            // создаем экземпляр класса PHPMailer
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            // настройки SMTP
            $mail->isSMTP();
            $mail->Host       = 'srvmail.atr-sz.ru';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ageev@atr-sz.ru';
            $mail->Password   = 'got500!!feetli';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 587;
            // настройки письма
            $mail->setFrom('ageev@atr-sz.ru', 'Your Name');
            $mail->addAddress('admin@example.com', 'Admin');
            $mail->isHTML(true);
            $mail->Subject = 'Сообщение из формы обратной связи';
            $mail->Body    = "<p>Имя: $name</p><p>Email: $email</p><p>Сообщение: $message</p>";
            // отправляем письмо
            if ($mail->send()) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Сообщение успешно отправлено',
                );
                echo "<script>alert('Данные успешно отправлены!');</script>";
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Ошибка при отправке сообщения'
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => implode('<br>', $errors)
            );
        }


    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.js"></script>
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                errors: [],
                name: null,
                email: null,
                message: null
            },
            methods: {
                checkForm: function (e) {
                    if (this.name && this.email && this.message) {
                        return true;
                    }

                    this.errors = [];

                    if (!this.name) {
                        this.errors.push('Требуется указать имя.');
                    }
                    if (!this.email) {
                        this.errors.push('Требуется указать email.');
                    }
                    e.preventDefault();
                },
                submitForm() {
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '/server.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = () => {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);
                            if (response.status === 'success') {
                                alert('Данные отправлены!');
                            } else {
                                this.errors = response.errors;
                            }
                        }
                    };
                    xhr.send(`name=${this.name}&email=${this.email}&message=${this.message}`);
                }
            }
        })
    </script>

</form>