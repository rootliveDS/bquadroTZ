<form id='app' method="post" @submit="checkForm">
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
        <textarea id="message" name="message" ></textarea>
    </div>
    <button type="submit" >Отправить</button>

</form>