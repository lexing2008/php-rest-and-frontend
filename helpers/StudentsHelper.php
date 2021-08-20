<?php
namespace Helpers;

use Core\DB;

/**
 * Хэлпер работы со студентами
 */
class StudentsHelper
{
    /**
     * Количество студентов на страницу
     */
    const COUNT_PER_PAGE = 5;
    
    /**
     * Возвращает массив студентов с заданной позиции
     * @param int $position позиция отсчета
     * @return array массив студентов
     */
    public function getUsers(int $position): array {
        
        $data = [];
        
        $db = DB::getInstance();
        $sth = $db->prepare('SELECT id, login, name FROM students LIMIT ?,?');
        $sth->execute([$position, self::COUNT_PER_PAGE]);
        while($row = $sth->fetch()){
            $data[] = $row;
        }
        
        return $data;
    }
    
    /**
     * Возвращает количество всего студентов в таблице
     * @return int количество студентов 
     */
    public function getCountUsers(): int {
        
        $sth = DB::getInstance()->query('SELECT count(*) FROM `students`');
        
        return $sth->fetchColumn();
    }
}
