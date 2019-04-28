<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-29
 * Time: 10:39
 */

namespace App\Gates;

use App\Exceptions\UnauthorizedException;

/**
 * Class RequestPostGate
 *
 * @package App\Gates
 */
class RequestPostGate implements GateInterface
{

    /**
     * Conditions to pass the middleware check
     *
     * @return bool
     */
    public function authorize() : bool
    {
        if (filter_var($_SERVER['REQUEST_METHOD']) === 'POST')
        {
            return true;
        }

        throw new UnauthorizedException('Invalid role permission');
    }
}