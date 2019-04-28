<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-10
 * Time: 23:05
 */

namespace App\Interfaces;

/**
 * Interface AuthUserInterface
 *
 * @package App\Interfaces
 */
interface AuthUserInterface
{
    /**
     * Get the users username.
     *
     * @return mixed
     */
    public function getUsername();

    /**
     * The last time the user logged in.
     *
     * @return mixed
     */
    public function getLastLoginTime();
}