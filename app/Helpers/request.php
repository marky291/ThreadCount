<?php

/**
 * @param string $url
 */
function redirect(string $url)
{
    if ($url === '/') {
        header('Location: http://threadcount.test', true, 301);
    } else {
        header("Location: http://threadcount.test/{$url}", true, 301);
    }

    exit();
}

/**
 * @return mixed
 */
function url()
{
    return filter_var($_SERVER['PHP_SELF']);
}

/**
 * @param string $key
 * @return bool
 */
function isCurrentUri(string $key)
{
    return $key === $_SERVER['REQUEST_URI'] ? 'selected' : '';
}
/**
 * @param string $query
 * @param string $value
 * @return bool
 */
function hasQueryString(string $query, string $value)
{
    return filter_var($_SERVER['QUERY_STRING']) === $query.'='.$value;
}