<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-16
 * Time: 13:01
 */

namespace App\Models;

use App\Classes\DB;

/**
 * Class Model
 *
 * @package App\Models
 */
abstract class Model
{
    protected static $sql;

    public function __construct()
    {
        self::$sql = DB::instance();
    }
}