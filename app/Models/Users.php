<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-10
 * Time: 21:11
 */

namespace App\Models;

use App\Classes\Database;
use App\Interfaces\AuthUserInterface;

/**
 * Class User
 *
 * @package App\Models
 */
class Users extends Model implements AuthUserInterface
{
    private $email;
    private $username;
    private $password;
    private $ip_address;

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = encrypt($password);
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return Users
     */
    public function setUsername($username): Users
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Users
     */
    public function setEmail($email): Users
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpAddress()
    {
        return $this->ip_address;
    }

    /**
     * @param mixed $ip_address
     * @return Users
     */
    public function setIpAddress($ip_address): Users
    {
        $this->ip_address = $ip_address;

        return $this;
    }

    /**
     * Get the users who has matching username and passwords.
     *
     * @param string $username
     * @param string $password
     * @return Database|bool|\mysqli_result
     */
    public static function whereUsernameAndPassword(string $username, string $password)
    {
        return Database::instance()->query("select * from users where username = '{$username}' and password = '{$password}'");
    }
}