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

       $permissions = Permissions::whereRoleID($result['role_id']);

       /**
        * Credentials from the result exist, lets build a user
        * model and apply it to the $_SESSION.
        */
       $user = new Users();
       $user->setUsername($result['username']);
       $user->setEmail($result['email']);
       $user->setRoleName($result['role_name']);
       $user->setIpAddress($result['ip_address']);
       $user->setLastLogin($result['timestamp']);
       $user->setAvatarUrl($result['avatar_url']);
       $user->setPermissions($permissions->toArray());

        // we save the new time after we have the old time.
        // so that we can see the OLD login timestamp not the CURRENT.
       $user->updateLastLogin($result['timestamp']);

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

        auth()->logCurrentUserOut();

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
         * Get the data if the user matches, otherwise an
         * empty result will mean nothing was found.
         */
        $result = Users::saveNewAccountDetails(
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

        /**
         * Credentials from the result exist, lets build a user
         * model and apply it to the $_SESSION.
         */
        $user = new Users();
        $user->setUsername($result['username']);
        $user->setEmail($result['email']);

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
}