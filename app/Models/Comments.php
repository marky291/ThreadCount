<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-11
 * Time: 18:21
 */

namespace App\Models;

use App\Classes\Database;

/**
 * Class Comments
 *
 * @package App\Models
 */
class Comments extends Model
{
    public static function whereThreadID(int $key)
    {
        return Database::instance()->query("
            select
              comments.comment_id,
              comments.content,
              comments.karma_score,
              comments.created_at,
              users.username as 'user.username',
              users.avatar_url as 'user.avatar',
              users.ip_address as 'user.ip_address'
            from
              comments
                inner join users on comments.creator_id = users.user_id
            where comments.thread_id = '{$key}';
        ");
    }
}