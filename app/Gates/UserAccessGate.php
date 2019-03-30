<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-29
 * Time: 10:38
 */

namespace App\Gates;

/**
 * Class UserAuthenticatedGate
 *
 * @package App\Gates
 */
class UserAccessGate implements GateInterface
{
    /**
     * Conditions to pass the middleware check
     *
     * @return bool
     */
    public function authorize() : bool
    {
        if (auth()->check() === false)
        {
            return redirect('auth/login');
        }

        return true;
    }
}