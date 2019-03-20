<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-10
 * Time: 23:20
 */

namespace App\Controllers;

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
     */
    public function login()
    {
        $this->render('auth.login', []);
    }

    /**
     * Validate a login request.
     */
    public function validate()
    {
        /**
         * This action requires an POST request method.
         */
        $this->requestGuard('POST');

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

    /**
     * Log a user out of the authentication system.
     */
    public function logout(): void
    {
        $this->requiresAuthentication();

        auth()->logCurrentUserOut();

        redirect('threads?topic=general');
    }
}