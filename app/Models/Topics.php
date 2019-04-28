<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-09
 * Time: 17:38
 */

namespace App\Models;


use App\Classes\Database;

class Topics extends Model
{
    /**
     * @return array
     */
    public static function all(): array
    {
        return Database::instance()->query('select * from topics')->get();
    }

    public static function saveFreshModel(int $creator_id, string $name, string $description)
    {
        return Database::instance()->query("
            insert into topics 
                (creator_id, title, description) 
            values 
               ('{$creator_id}', '{$name}', '{$description}');
        ");
    }

    /**
     * Delete a specified topic at the id location
     *
     * @param string $topic_id
     * @return Database|bool|mixed|\mysqli_result
     */
    public static function deleteWhereID(string $topic_id)
    {
        return Database::instance()->query("
            delete from topics where topic_id = '{$topic_id}';
        ");
    }
}