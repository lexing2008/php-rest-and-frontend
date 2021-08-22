# php-rest-and-frontend

Сайт работает на php 7.4

1. Клонируем репозиторий на сервер
2. Импортируем данные из db_test_learn.sql в БД
3. Конфигурация сайта:

Файл конфигурации:
config/Config.php

Необходимо изменить на свои:


    /**
     * Настройки соединения с БД
     * @var array 
     */
    public array $db = [
        'host' => 'localhost',
        'name' => 'db_test_learn',
        'user' => 'root',
        'password' => '',        
    ];
 

    /**
     * Домен сайта
     * @var string 
     */
    public string $domain = 'php-rest-and-frontend';

 4. Учетные данные пользователя в системе:
 
Логин: user
Пароль: 123456
