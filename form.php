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
    if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
        echo "<script>alert('Данные успешно отправлены!');</script>";
    }
    ?>
    <script src="https://unpkg.com/vue@2.7.14/dist/vue.js"></script>
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
                }
            }
        })
    </script>

</form>