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
            if (this.name && this.email) {
                return true;
            }

            this.errors = [];

            if (!this.name) {
                this.errors.push('Требуется указать имя.');
            }
            if (!this.email) {
                this.errors.push('Требуется указать email.');
            }else if (!this.validEmail(this.email)) {
                this.errors.push('Укажите корректный адрес электронной почты.');
            }

            e.preventDefault();
        }
    }
})