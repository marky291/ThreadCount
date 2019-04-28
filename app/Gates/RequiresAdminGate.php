<?php


namespace App\Gates;


use App\Exceptions\UnauthorizedException;

class RequiresAdminGate implements GateInterface
{

    /**
     * Conditions to pass the gate check
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if (auth()->check() && auth()->user()->hasRole(['super', 'admin']))
        {
            return true;
        }

        throw new UnauthorizedException('Invalid role permission');
    }
}