<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-04-01
 * Time: 14:49
 */

namespace App\Models;


use App\Classes\Database;

class Permissions extends Model
{
    /**
     * Get all the permissions that belong to a certain role.
     *
     * @param int $id
     * @return Database
     */
    public static function whereRoleId(int $id): Database
    {
        return Database::instance()->query("
            select
                permissions.name as 'permission'
            from
              permissions
            where 
              permissions.role_id = '{$id}';
        ");
    }
}