<?php
namespace Core;

use Core\DB;
use Config\Config;
use Core\Trates\Singleton;
use Helpers\ResponseHelper;
use Controllers\ApiController;


/**
 * Класс приложения MVC
 */
class App
{
    /**
     * Делаем класс Одиночкой
     */
    use Singleton;
    
    /**
     * Префикс домена для параметра сессии
     */
    const DOMAIN_PREFIX = '.';
    
    /**
     * Запуск приложения
     */
    public function run(){
        $config = Config::getInstance();
                
        // запускаем сессию
        $this->sessionStart();
        
        // подключаемся к БД
        $db = DB::getInstance();
        $db->connect();

        // роутинг запроса
        $this->routing();

        // закрываем соединение с БД
        $db->close();   
    }

    /**
     * Старт сессии
     */
    public function sessionStart(){
        $config = Config::getInstance();

        session_name( $config->sessionName );
        session_start();        
    }
    
    /**
     * Роутинг. Запуск нужного экшена контроллера
     */
    public function routing(){

        $action = $_GET['action'];

        $controller = new ApiController();

        // проверяем наличие экшена в контроллере
        if( method_exists($controller, $action) ) {
            $controller->$action();
        } else {
            (new ResponseHelper)->jsonError(['Такого action не существует']);
        }
    }
}
