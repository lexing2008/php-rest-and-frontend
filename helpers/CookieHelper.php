<?php

namespace Helpers;

use Config\Config;
use Core\App;

/**
 * Класс работы с COOKIE
 * Позволяет устанавливать и удалять куки
 */
class CookieHelper {
    /**
     * Путь на сервере по умолчанию, на котором cookie будет доступен.
     */
    const DEFAULT_PATH = '/';
    
    /**
     * Время жизни куки при удалении куки
     */
    const LIFETIME_DELETE = -365 * 24 * 3600;
    
    /**
     * Пустое значение
     */
    const EMPTY_VALUE = '';

    /**
     * Установка COOKIE
     * @param string $name название куки
     * @param mixed $value значение куки
     * @param int $lifetime время жизни куки в секундах
     */
    public static function setCookie(string $name, $value, int $lifetime )
    {
        $config = Config::getInstance();
        setcookie($name, $value, time() + $lifetime, self::DEFAULT_PATH, App::DOMAIN_PREFIX . $config->domain);
        $_COOKIE[$name] = $value;
    }

    /**
     * Удаление COOKIE
     * @param string $name название куки
     */
    public static function deleteCookie(string $name)
    {
        self::setCookie($name, self::EMPTY_VALUE, self::LIFETIME_DELETE);
        unset($_COOKIE[$name]);
    }
}
