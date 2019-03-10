<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-09
 * Time: 17:38
 */

namespace App\Models;


use App\Classes\DB;

class Topics
{
    public static function all()
    {
        return DB::instance()->query('select * from topics');
    }
}