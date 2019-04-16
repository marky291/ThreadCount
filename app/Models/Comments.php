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
              users.user_id as 'user.user_id',
              users.username as 'user.username',
              users.avatar_url as 'user.avatar',
              users.ip_address as 'user.ip_address'
            from
              comments
                inner join users on comments.creator_id = users.user_id
            where comments.thread_id = '{$key}';
        ");
    }

    public static function whereID(int $key)
    {
        return Database::instance()->query("
            select
              comments.comment_id,
              comments.content,
              comments.karma_score,
              comments.created_at,
              users.user_id as 'user.user_id',
              users.username as 'user.username',
              users.avatar_url as 'user.avatar',
              users.ip_address as 'user.ip_address'
            from
              comments
                inner join users on comments.creator_id = users.user_id
            where comments.comment_id = '{$key}';
        ");
    }

    /**
     * Save a newly made, fresh model.
     *
     * @param int $creator_id
     * @param int $thread_id
     * @param string $content
     * @return Database|bool|mixed|\mysqli_result
     */
    public static function saveFreshModel(int $creator_id, int $thread_id, string $content)
    {
        return Database::instance()->query("
            insert into comments 
                (creator_id, thread_id, content) 
            values 
               ('{$creator_id}', '{$thread_id}', '{$content}');
        ");
    }

    /**
     * Delete a comment where its ID matches the input value.
     *
     * @param string $commentID
     * @return Database|bool|mixed|\mysqli_result
     */
    public static function deleteID(string $commentID)
    {
        return Database::instance()->query("
            delete from  comments where comment_id = '{$commentID}';
        ");
    }
}