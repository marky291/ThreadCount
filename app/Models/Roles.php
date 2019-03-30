<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-09
 * Time: 16:54
 */

namespace App\Models;

use App\Classes\Database;

/**
 * Class Roles
 *
 * @package App\Models
 */
class Roles extends Model
{
    public static function all()
    {
        return Database::instance()->query("select * from roles");
    }
}