<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-20
 * Time: 23:12
 */

namespace App\Classes;

/**
 * Class Url
 *
 * @package App\Classes
 */
class Server
{
    /**
     * @var array server request.
     */
    public $server = [];

    /**
     * @var Server
     */
    private static $instance;

    /**
     * Url constructor.
     */
    public function __construct()
    {
        foreach ($_SERVER as $assoc)
        {
            $this->server[] = filter_var($assoc);
        }
    }

    /**
     * Check if the query and value exists in the query URI
     *
     * Good for checking front end logic (selected menus etc..)
     *
     * @param string $query
     * @param string $value
     * @return bool
     */
    public function hasQueryString(string $query, string $value): bool
    {
        return filter_var($this->server['QUERY_STRING']) === $query.'='.$value;
    }

    /**
     * Return the current URI route.
     *
     * @return mixed
     */
    public function currentUri()
    {
        return $this->server['REQUEST_URI'];
    }

    /**
     * Current website hostname.
     *
     * @return mixed
     */
    public function hostname()
    {
        return $this->server['HTTP_HOST'];
    }

    /**
     * Get the current url request method  type.
     *
     * @return mixed
     */
    public function requestMethod()
    {
        return $this->server['REQUEST_METHOD'];
    }

    /**
     * Check  if the current url is a post request method.
     *
     * @return bool
     */
    public function isPostRequest(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Check  if the current url is a get request method.
     *
     * @return bool
     */
    public function isGetRequest(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    /**
     * Return singleton instance of self.
     *
     * @return Server
     */
    public static function instance(): Server
    {
        if (self::$instance)
        {
            return self::$instance;
        }

        return self::$instance = new self;
    }
}