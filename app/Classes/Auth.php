<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-10
 * Time: 21:23
 */

namespace App\Classes;

use App\Interfaces\AuthUserInterface;
use App\Models\Users;
use Carbon\Carbon;

class Auth
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * @var Users
     */
    private $user;

    /**
     * stored as ... on session array.
     */
    public const session_key = 'user';

    /**
     * @return Auth
     */
    public static function instance(): Auth
    {
        return self::$instance ?? self::$instance = new self;
    }

    /**
     * Set the current auth user session.
     *
     * @param mixed ...$user
     * @return void
     */
    public function setUserSession($user): void
    {
        if ($user instanceof Users)
        {
            $this->user = $user;
        }
    }

    /**
     * @param AuthUserInterface $user
     */
    public function logUserIn(AuthUserInterface $user)
    {
        if ($user->getUsername())
        {
            $this->setAuthSessionData($user);
        }
    }

    /**
     * Log a user out of the system.
     */
    public function logout(): void
    {
        if ($this->check())
        {
            $this->setAuthSessionData(null);
        }
    }

    /**
     * @param $data
     */
    private function setAuthSessionData($data)
    {
        $_SESSION[self::session_key] = $data;
    }

    /**
     * return the user class from the auth session.
     *
     * @return Users
     */
    public function user(): Users
    {
        return $this->user;
    }

    /**
     * Check if there is a user session.
     *
     * @return bool
     */
    public function check(): bool
    {
        return isset($this->user);
    }
}