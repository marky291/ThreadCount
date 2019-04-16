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
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $ipAddress;
    /**
     * @var string
     */
    private $lastLogin;
    /**
     * @var string
     */
    private $avatarUrl;
    /**
     * @var string
     */
    private $roleName;
    /**
     * @var array
     */
    private $permissions;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
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
        return $this->ipAddress;
    }

    /**
     * @param mixed $ip_address
     * @return Users
     */
    public function setIpAddress($ip_address): Users
    {
        $this->ipAddress = $ip_address;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * @param string $role
     * @return Users
     */
    public function setRoleName(string $role): self
    {
        $this->roleName = $role;

        return $this;
    }

    /**
     * Pass an array of roles to check if the user has.
     *
     * @param array $roleNames
     * @return bool
     */
    public function hasRole(array $roleNames): bool
    {
        foreach ($roleNames as $role)
        {
            if ($role === $this->getRoleName())
            {
                return true;
            }
        }

        return false;
    }

    /**
     * @return string
     */
    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }

    /**
     * @param string $avatarUrl
     */
    public function setAvatarUrl(string $avatarUrl): void
    {
        $this->avatarUrl = $avatarUrl;
    }

    /**
     * @return string
     */
    public function getLastLogin(): string
    {
        return $this->lastLogin;
    }

    /**
     * @param string $lastLogin
     */
    public function setLastLogin(string $lastLogin): void
    {
        $this->lastLogin = $lastLogin;
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    /**
     * @param array $permissions
     * @return Users
     */
    public function setPermissions(array $permissions): self
    {
        $this->permissions = $permissions;

        return $this;
    }

    public function updateLastLogin(string $timestamp)
    {
        Database::instance()->query("update users set last_login = '{$timestamp}' where username = '{$this->username}'");
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
        return Database::instance()->query("
            select
              users.user_id as `user_id`,
              users.username,
              users.email,
              users.ip_address,
              users.avatar_url,
              users.last_login,
              roles.role_id,
              roles.name as role_name,
              (select now()) as 'timestamp'
            from
              users
            inner join roles on users.role_id = roles.role_id
            where
              username = '{$username}' and password = '{$password}';
        ");
    }

    public static function saveNewAccountDetails(string $forename, string $surname, string $email, string $password)
    {

    }
}