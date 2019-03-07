<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-02-27
 * Time: 17:10
 */

namespace App;

use App\Interfaces\DatabaseInterface;

/**
 * Class MysqlDatabase
 *
 * @package App
 */
class Database implements DatabaseInterface
{
    /** @var \mysqli */
    private $connection;

    public function __construct()
    {
        //$this->connection = new \mysqli('127.0.0.1', 'root', 'password', 'ThreadCount');
    }
}