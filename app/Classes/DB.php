<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-02-27
 * Time: 17:10
 */

namespace App\Classes;

/**
 * Class MysqlDatabase
 *
 * @package App
 */
class DB extends \mysqli
{
    /**
     * @var self;
     */
    private static $instance;

    /**
     * DB constructor.
     */
    public function __construct()
    {
        parent::__construct(
            config('database.connection.host'),
            config('database.connection.username'),
            config('database.connection.password'),
            config('database.connection.schema'),
            config('database.connection.port'),
            config('database.connection.socket')
        );
    }

    /**
     * Dont think its needed by its in the project... meh..
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * @param string $query
     * @param int $resultmode
     * @return array
     */
    public function query($query, $resultmode = MYSQLI_STORE_RESULT)
    {
        $data = [];

        $result = parent::query($query, $resultmode);

        while($row = $result->fetch_assoc())
        {
            $data[] = $row;
        }

        return $data;
    }

    /**
     * Singleton instance.
     *
     * @return DB|\mysqli
     */
    public static function instance()
    {
        return  self::$instance ?? self::$instance = new self;
    }
}