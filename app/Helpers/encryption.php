<?php

/**
 * Our encryption algorithm.
 *
 * @param string $value
 * @return string
 */
function encrypt(string $value)
{
    return hash('ripemd160', $value);
}