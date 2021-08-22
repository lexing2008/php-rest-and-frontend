/**
 * Статус ответа Api ok
 * @type String
 */
const RESPONSE_STATUS_OK = 'ok';

let app = new Vue({
    el: '#block-login',
    data: {
        login: '', // логин
        password: '', // пароль
        remember: false, // флаг необходимости запомнить авторизацию
        messageError: '' // сообщение об ошибке
    },
    methods: {
        /**
         * Авторизация в сервисе
         */
        loginInService: function () {
            this.messageError = '';
            if (this.login == '') {
                this.messageError = 'Логин не должен быть пустым';
                return;
            }
            if (this.password == '') {
                this.messageError = 'Пароль не должен быть пустым';
                return;
            }

            $.ajax({
                url: "api.php?action=auth",
                type: "POST",
                data: {
                    login: this.login,
                    password: this.password,
                    remember: this.remember,
                },
                success: response => {
                    if (response.status == RESPONSE_STATUS_OK) {
                        document.location.href = 'users.htm';
                    } else {
                        this.messageError = response.messages[0];
                    }
                },
                dataType: 'json'
            });
        }
    }
});