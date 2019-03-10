<?php

/**
 * @param string $url
 */
function redirect(string $url)
{
    header("Location: http://threadcount.test/{$url}", true, 301);

    exit();
}
