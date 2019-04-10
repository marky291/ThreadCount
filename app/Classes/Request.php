<?php

namespace App\Classes;

/**
 * Class Request
 *
 * @package App
 */
class Request
{
    /**
     * @var array
     */
    private $get;

    /**
     * @var array
     */
    private $post;

    /**
     * @var array
     */
    private $session;

    /**
     * @var array
     */
    private $server;

    /**
     * Request constructor.
     *
     * @param array $get
     * @param array $post
     * @param array $session
     * @param array $server
     */
    public function __construct(array $get, array $post, array $session, array $server)
    {
        $this->get = $get;

        $this->post = $post;

        $this->session = $session;

        $this->server = $server;
    }

    /**
     * Get a value from the current get request
     *
     * @param string $key
     * @return string
     */
    public function get(string $key = null) : string
    {
        return htmlentities($this->get[$key]);
    }

    /**
     * Get the value from the current post request.
     *
     * @param string $key
     * @return string
     */
    public function post(string $key) : string
    {
        return htmlentities($this->post[$key]);
    }

    /**
     * Get the value form the current session request.
     *
     * @param string $key
     * @return string
     */
    public function session(string $key) : string
    {
        return htmlentities($this->session[$key]);
    }

    /**
     * Get the value form the current session request.
     *
     * @param string $key
     * @return string
     */
    public function server(string $key) : string
    {
        return htmlentities($this->server[$key]);
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
        return $this->server('QUERY_STRING') === $query.'='.$value;
    }

    /**
     * Return the current URI route.
     *
     * @return mixed
     */
    public function currentUri()
    {
        return $this->server('REQUEST_URI');
    }

    /**
     * Current website hostname.
     *
     * @return mixed
     */
    public function hostname()
    {
        return $this->server('HTTP_HOST');
    }

    /**
     * Check  if the current url is a post request method.
     *
     * @return bool
     */
    public function isPostMethod(): bool
    {
        return $this->method() === 'POST';
    }

    /**
     * Check  if the current url is a get request method.
     *
     * @return bool
     */
    public function isGetMethod(): bool
    {
        return $this->method() === 'GET';
    }

    /**
     * Get the current url request method  type.
     *
     * @return mixed
     */
    public function method()
    {
        return $this->server('REQUEST_METHOD');
    }
}