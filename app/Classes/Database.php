<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-02-27
 * Time: 17:10
 */

namespace App\Classes;

use App\Exceptions\Exception;

/**
 * Class MysqlDatabase
 *
 * @package App
 */
class Database extends \mysqli
{
    /**
     * @var self;
     */
    private static $instance;

    /**
     * Store a query collection result.
     *
     * @var array
     */
    private $collection = [];

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

        if ($this->connect_error) {
            die('Connection failed: ' . $this->connect_error);
        }
    }

    /**
     * Dont think its needed by its in the project... meh..
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * Singleton instance.
     *
     * @return Database|\mysqli
     */
    public static function instance()
    {
        return self::$instance ?? self::$instance = new self;
    }

    /**
     * @param string $query
     * @param int $resultmode
     * @return Database|mixed
     */
    public function query($query, $resultmode = MYSQLI_STORE_RESULT)
    {
        $this->collection = [];

        $result = parent::query($query, $resultmode);

        if (is_bool($result)) {
            return $result;
        }

        if ($this->error) {
           throw new Exception($this->error);
        }

        while ($row = $result->fetch_assoc()) {
            $this->collection[] = $row;
        }

        $result->free();

        return $this;
    }

    /**
     * Return first result of return Empty Result.
     *
     * @return array|mixed
     */
    public function first()
    {
        return $this->collection[0] ?? $this->collection;
    }

    /**
     * Return all the results of the query.
     *
     * @return array
     */
    public function get(): array
    {
        return $this->collection;
    }

    /**
     * Join all the resulting columns to form an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $collection = [];

        foreach ($this->collection as $key => $item)
        {
            $collection[] = array_values($item)[0];
        }

        return $collection;
    }
}