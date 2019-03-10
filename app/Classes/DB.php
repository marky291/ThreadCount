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
     * @param string $query
     * @param int $resultmode
     * @return array
     */
    public function query($query, $resultmode = MYSQLI_STORE_RESULT)
    {
        $data = [];

        $result  = parent::query($query, $resultmode);
//
//        $classes = [];
//
//        $result  = parent::query($query, $resultmode);
//
//        while($row = $result->fetch_row())
//        {
//            for ($i = 0; $i < $result->field_count; $i++)
//            {
//                $field = $result->fetch_field();
//
//                $class = "App\\Models\\" . ucfirst($field->orgtable);
//                $method = 'set' . ucfirst($field->name);
//
//                if (array_key_exists($class, $classes))
//                {
//                    $object = $classes[$class];
//                }
//                else
//                {
//                    $object = array_push($classes, [$class => new $class()]);
//                }
//
//                var_dump($classes);
//
//                if (method_exists($object, $method))
//                {
//                    $object->$method($row[$i]);
//                }
//                else
//                {
//                    echo $method . " does not exist";
//                }
//
//                var_dump($object);
//            }
//        }
//
//        exit();
//
//
//        for ($i = 0; $i < $result->field_count; $i++)
//        {
//            $fields = $result->fetch_field();
//            $attribute = $result->fetch_row();
//
//            var_dump($fields->name, $attribute[$i]);
//
//            $class = "App\\Models\\" . ucfirst($fields->orgtable);
//
//            $object = new $class;
//
//            $method = 'set' . ucfirst($fields->name);
//
//            if (method_exists($object, $method))
//            {
//                $object->$method($attribute[$i]);
//            }
//
//            var_dump($object);
//        }
//
//        exit();

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