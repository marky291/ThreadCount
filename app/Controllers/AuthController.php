<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-10
 * Time: 23:20
 */

namespace App\Controllers;


use App\Models\Users;

class AuthController extends Controller
{
    /**
     * Login a user to the authentication system.
     */
    public function login()
    {
        $user = (new Users())->setUsername('marky291');

        auth()->logUserIn($user);

        redirect('threads?topic=general');
    }

    /**
     * Log a user out of the authentication system.
     */
    public function logout()
    {
        auth()->logCurrentUserOut();

        redirect('threads?topic=general');
    }
}