<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-29
 * Time: 10:44
 */

namespace App\Gates;


interface GateInterface
{
    /**
     * Conditions to pass the gate check
     *
     * @return bool
     */
    public function authorize() : bool;
}