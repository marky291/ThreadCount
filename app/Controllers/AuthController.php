<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-10
 * Time: 23:20
 */

namespace App\Controllers;

use App\Classes\Database;
use App\Models\Permissions;
use App\Models\Users;

/**
 * Class AuthController
 *
 * @package App\Controllers
 */
class AuthController extends Controller
{
    /**
     * Login a user to the authentication system.
     *
     * GET REQUEST MEANS SHOW FORM
     * POST REQUEST MEANS ATTEMPT LOGIN
     */
    public function login()
    {
       if ($this->request->isGetMethod()) {
           return $this->gates(['guest'])->render('auth.login');
       }

       /**
        * This action requires an POST request method.
        * This action allows only guests to access.
        */
       $this->gates(['guest', 'post']);

       /**
        * Get the data if the user matches, otherwise an
        * empty result will mean nothing was found.
        */
       $result = Users::whereUsernameAndPassword(
           $this->request->post('username'),
           $this->request->post('password')
       )->first();

       /**
        * We want to redirect back to login with the errors
        * if the result was an empty set of data.
        */
       if (!$result) {
           return $this->render('auth.login', ['errors' => [
               'username' => 'Invalid Credentials Entered',
               'password' => 'Invalid Credentials Entered'
           ]]);
       }

        // Store the user login, time and ip_address
        $log = Users::storeNewLoginLogFor($result['user_id']);

       /**
        * Credentials from the result exist, lets build a user
        * model and apply it to the $_SESSION.
        */
       $user = new Users();
       $user->setId($result['user_id']);
       $user->setUsername($result['username']);
       $user->setEmail($result['email']);
       $user->setRoleName($result['role_name']);
       $user->setIpAddress($log['ip_address']);
       $user->setLastLoginTime($log['login_time']);
       $user->setAvatarUrl($result['avatar_url']);

       /**
        * Since the user model is now built, lets log it into the
        * auth class that handles the authentication.
        */
       auth()->logUserIn($user);

       /**
        * Redirect to the homepage.
        */
       return redirect('');
    }

    /**
     * Log a user out of the authentication system.
     */
    public function logout(): void
    {
        $this->gates(['auth']);

        auth()->logout();

        redirect('threads?topic=general');
    }

    /**
     *  Register a new account to the system
     *
     * Get methods show form.
     * Post methods process form.
     */
    public function register()
    {
        if ($this->request->isGetMethod()) {
            return $this->gates(['guest'])->render('auth.register');
        }

        /**
         * This action requires an POST request method.
         * This action allows only guests to access.
         */
        $this->gates(['guest', 'post']);

        /**
         * Important we check that the user exists first, since this must be unique.
         */
        $userExists = Users::whereUsername($this->request->post('username'))->first();

        /**
         * Redirect back with error message and a flash of the data.
         */
        if ($userExists == true)
        {
            return $this->render('auth.register', [
                'errors' => [
                    'message' => 'Username already taken',
                ],
                'flash' => [
                    'username' => $this->request->post('username'),
                    'email' => $this->request->post('email')
                ]
            ]);
        }

        /**
         * Get the data if the user matches, otherwise an
         * empty result will mean nothing was found.
         */
        $result = Users::saveNewAccountDetails(
            $this->request->post('username'),
            $this->request->post('email'),
            $this->request->post('password')
        );

        /**
         * Redirect to the login page to allow user to login.
         */
        return $this->render('auth.login', ['success' => [
            'message' => 'You can now login with your new account'
        ]]);
    }
}