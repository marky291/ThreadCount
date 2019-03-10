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
     * Get the user ID.
     *
     * @return mixed
     */
    public function getUsername();
}