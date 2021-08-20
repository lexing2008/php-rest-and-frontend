# php-rest-and-frontend

1. Клонируем репозиторий на сервер
2. Импортируем данные из db_test_learn.sql в БД
3. Конфигурация БД:

Файл конфигурации:
config/Config.php

Необходимо изменить на свои:


    /**
     * Настройки соединения с БД
     * @var array 
     */
    public $db = [
        'host' => 'localhost',
        'name' => 'db_test_learn',
        'user' => 'root',
        'password' => '',        
    ];
 
 4. Учетные данные пользователя в системе:
Логин: user
Пароль: 123456
