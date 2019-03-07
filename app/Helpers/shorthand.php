<?php

function config(string $key = null)
{
    if ($key)  {
        return \App\Config::instance()->items->get($key);
    }

    return \App\Config::instance()->items;
}