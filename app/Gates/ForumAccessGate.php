<?php

namespace App\Gates;

use App\Exceptions\UnauthorizedException;

/**
 * Class ForumAccessGate
 *
 * @package App\Gates
 */
class ForumAccessGate implements GateInterface
{

    /**
     * Conditions to pass the gate check
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if (auth()->check() && auth()->user()->hasRole(['banned']))
        {
            echo 'You have been banned from viewing or accessing this forum. <br><br>';

            echo 'For this demonstration however you will be logged out again on refresh.';

            auth()->logout();

            exit();
        }

        return true;
    }
}