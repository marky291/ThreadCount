<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-09
 * Time: 16:54
 */

namespace App\Models;

use App\Classes\DB;

/**
 * Class Roles
 *
 * @package App\Models
 */
class Roles
{
    public static function all()
    {
        return DB::instance()->query("select * from roles");
    }
}