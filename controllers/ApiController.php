<?php

namespace Controllers;

use Helpers\UserHelper;
use Helpers\{ResponseHelper, StudentsHelper};

/**
 * Контроллер Rest APi
 *
 * @author Lexing
 */
class ApiController
{
    /**
     * Метод запроса GET
     */
    const REQUEST_METHOD_GET = 'GET';
    
    /**
     * Метод запроса POST
     */
    const REQUEST_METHOD_POST = 'POST';
    
    /**
     * Метод запроса DELETE
     */
    const REQUEST_METHOD_DELETE = 'DELETE';
    
    /**
     * Действия связанные с авторизацией
     */
    public function auth(){

        // проверяем метод запроса
        switch ($_SERVER['REQUEST_METHOD']) {
            case self::REQUEST_METHOD_POST:
                $this->authLogin();
                break;
            case self::REQUEST_METHOD_DELETE:
                $this->authLogout();
                break;
            default:
                (new ResponseHelper)->jsonError(['Недопустимый метод запроса']);
                break;
        }
    }
    
    /**
     * Получение списка пользователей
     */
    public function users(){
        
        $response = new ResponseHelper;
        // если не метод запроса GET
        if($_SERVER['REQUEST_METHOD'] != self::REQUEST_METHOD_GET){
            $response->jsonError(['Недопустимый метод запроса']);
            return;
        }

        $userHelper = new UserHelper;
        if(!$userHelper->isAuth()){
            // пытаемся авторизоваться по хэшу в куках
            if(!$userHelper->authByHash()){
                $response->jsonError(['Вы не авторизированы']);
                return;
            }
        }
        
        $position = (int)$_GET['position'];
        $helper = new StudentsHelper;
        
        $response->jsonOk([
                    'countAll' => $helper->getCountUsers(),
                    'students' => $helper->getUsers($position),
                ]);
    }
    
    /**
     * Авторизация
     */
    private function authLogin(){
        
        $response   = new ResponseHelper;
        $helper     = new UserHelper;
        
        if($helper->isAuth()){
            $response->jsonError(['Вы уже авторизованы. Выйдите из системы']);
            return;
        }
        
        $login      = (string)$_POST['login'];
        $password   = (string)$_POST['password'];
        $remember   = (bool)$_POST['remember'];
        
        if(empty($login)){
            $response->jsonError(['Логин должен быть не пустым']);    
            return;
        }
        if(empty($password)){
            $response->jsonError(['Пароль должен быть не пустым']);    
            return;
        }

        $helper->authByLogin($login, $password, $remember);

        if($helper->isAuth()){
            $response->jsonOk();
        } else {
            $response->jsonError(['Неудача при авторизации, проверьте правильность логина и пароля']);    
        }
    }
    
    /**
     * Выход из системы
     */
    private function authLogout(){
        
        (new UserHelper())->logout();
        
        (new ResponseHelper)->jsonOk();
    }
}
