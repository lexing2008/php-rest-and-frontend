/**
 * Количество записей, отображаемое на страницу
 * @type Number
 */
const COUNT_PER_PAGE = 5;

/**
 * Статус ответа Api ok
 * @type String
 */
const RESPONSE_STATUS_OK = 'ok';

let app = new Vue({
    el: '#app',
    data: {
        pages: [], // страницы постраничной навигации
        users: [], // записи выводимых пользователей
        countAll: 0, // количество всего записей
        pageNumber: 1 // текущая страница
    },
    methods: {
        /**
         * Подгружаем пользователей (студентов)
         */
        loadUsers: function () {
            axios
                    .get('api.php?action=users')
                    .then(response => {
                        if (response.data.status == RESPONSE_STATUS_OK) {
                            this.countAll = response.data.data.countAll;
                            this.users = response.data.data.students;
                            this.createPages();
                        } else {
                            document.location.href = 'login.htm';
                        }
                    });
        },
        
        /**
         * Подгружаем страницу
         * @param int pageNumber
         */
        loadPage: function (pageNumber) {
            if (pageNumber != 0) {
                this.pageNumber = pageNumber;
            } else {
                pageNumber = this.pageNumber = this.pageNumber + 1;
            }

            pos = (pageNumber - 1) * COUNT_PER_PAGE;
            axios
                    .get('api.php?action=users&position=' + pos)
                    .then(response => {
                        if (response.data.status == 'ok') {
                            this.countAll = response.data.data.countAll;
                            this.users = response.data.data.students;
                            this.createPages();
                        } else {
                            alert(response.data.messages[0]);
                        }
                    });
        },
        
        /**
         * Создаем постраничную навигацию
         */
        createPages: function () {
            // формируем страницы
            this.pages = [];
            pages = this.countAll / COUNT_PER_PAGE;
            for (let i = 0; i < pages; ++i) {
                this.pages.push(i + 1);
            }
            if (this.countAll % COUNT_PER_PAGE != 0) {
                this.pages.push(i + 1);
            }
        },
        
        /**
         * Выход с сайта
         */
        logout: function () {
            $.ajax({
                url: "api.php?action=auth",
                type: "DELETE",
                data: {},
                success: function (response) {
                    if (response.status == 'ok') {
                        document.location.href = 'login.htm';
                    } else {
                        alert(response.messages[0]);
                    }
                },
                dataType: 'json'
            });
        }
    },
    beforeMount() {
        this.loadUsers()
    }
});
