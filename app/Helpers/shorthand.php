<?php

/**
 * @param string|null $key
 * @return \Adbar\Dot|mixed
 */
function config(string $key = null)
{
    if ($key !== null)  {
        return App\Classes\Config::instance()->items->get($key);
    }

    return App\Classes\Config::instance()->items;
}

/**
 * Return user authentication singleton instance.
 *
 * @return \App\Classes\Auth
 */
function auth()
{
    return \App\Classes\Auth::instance();
}