<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-29
 * Time: 10:49
 */

namespace App\Gates;

/**
 * Class GuestAccessGate
 *
 * @package App\Gates
 */
class GuestAccessGate implements GateInterface
{
    /**
     * Conditions to pass the gate check
     */
    public function authorize() : bool
    {
        if (auth()->check() === true)
        {
            return redirect('/');
        }

        return true;
    }
}