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
}