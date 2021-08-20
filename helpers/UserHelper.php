<?php
namespace Helpers;

use Core\DB;
use Helpers\CookieHelper;

/**
 * Хэлпер работы с пользоватлем
 */
class UserHelper
{
    /**
     * Соль для хэша пароля
     */
    const HASH_SALT = '445464646545a6d456aa4d54adad44d4';
    
    /**
     * Время жизни куки авторизации
     */
    const COOKIE_AUTH_HASH_LIFETIME = 365*24*3600;
    
    /**
     * Возвращает является пользователь авторизованным
     * @return bool является пользователь авторизованным
     */
    public function isAuth(): bool {
        
        return !empty($_SESSION['user']);
    }
    
    /**
     * Возвращает хэш пароля
     * @param string $password пароль
     * @return string хэш пароля
     */
    public function getPasswordHash(string $password): string {
        
        return md5(self::HASH_SALT . md5(self::HASH_SALT .$password));
    }
    
    /**
     * Авторизация в системе
     * @param string $login логин
     * @param string $password пароль
     * @param bool $remember запоминать пользователя или нет
     * @return bool
     */
    public function authByLogin(string $login, string $password, bool $remember = false): bool {
        
        $db = DB::getInstance();
        
        $sth = $db->prepare('SELECT id, login FROM `api_users` WHERE `login` = :login AND password = :password');
        $sth->execute([
                'login'     => $login,
                'password'  => $this->getPasswordHash($password)
            ]);

        $user = $sth->fetch();

        if(!empty($user)){
            //  запоминаем пользователя в сессии
            $_SESSION['user'] = $user;
            
            if($remember){
                // запоминаем пользователя по хэшу в куке
                $hash = md5(time() . $user['id']);

                $sth = $db->prepare('INSERT INTO `auth_hashes` 
                                        SET `user_id` = :user_id, 
                                            `hash` = :hash,
                                            `lifetime` = :lifetime');
                $sth->execute([
                    'user_id' => $user['id'],
                    'hash' => $hash,
                    'lifetime' => time() + self::COOKIE_AUTH_HASH_LIFETIME,
                ]);

                CookieHelper::setCookie('authHash', $hash, self::COOKIE_AUTH_HASH_LIFETIME);
                CookieHelper::setCookie('userId', $row['id'], self::COOKIE_AUTH_HASH_LIFETIME);
            }

        }
        
        
        return $this->isAuth();
    }
    
    /**
     * Авторизация по хэшу в куке
     * @return bool авторизовался ли
     */
    public function authByHash(): bool{
        
        $authHash = $_COOKIE['authHash'];
        $userId = (int)$_COOKIE['userId'];

        if(!empty($authHash) && !empty($userId)){
            $sth = $db->prepare('SELECT id, login
                                    FROM auth_hashes as h 
                                    JOIN `api_users` u ON h.user_id = u.id 
                                    WHERE h.`hash` = :hash AND h.user_id = :user_id');
            $sth->execute([
                    'hash'     => $authHash,
                    'user_id'  => $userId
                ]);

            $user = $sth->fetch();

            if(!empty($user)){
                //  запоминаем пользователя в сессии
                $_SESSION['user'] = $user;
            }
        }
        return $this->isAuth();
    }
    
    /**
     * Выход пользователя из системы
     */
    public function logout(){
        unset($_SESSION['user']);
        CookieHelper::deleteCookie('authHash');
        CookieHelper::deleteCookie('userId');
    }
}
