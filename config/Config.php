<?php
namespace Config;

use Core\Trates\Singleton;

/**
 * Класс содержит конфигурационные настройки
 */
class Config {
    /**
     * Делаем класс Одиночку используя трейти Singleton
     */
    use Singleton;
    
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
     * Имя сессии
     * @var string 
     */
    public string $sessionName = 'TEST2_BY';
    
    /**
     * Домен сайта
     * @var string 
     */
    public string $domain = 'php-rest-and-frontend';
}