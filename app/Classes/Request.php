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
     * Request constructor.
     *
     * @param array $get
     * @param array $post
     * @param array $session
     */
    public function __construct(array $get, array $post, array $session)
    {
        $this->get = $get;

        $this->post = $post;

        $this->session = $session;
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
}