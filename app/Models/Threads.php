<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-09
 * Time: 17:42
 */

namespace App\Models;


use App\Classes\Database;

class Threads extends Model
{
    public static function all(): array
    {
        return Database::instance()->query("
            select 
                threads.thread_id,
                threads.title,
                threads.slug,
                threads.content,
                topics.title as 'topic.title',
                threads.views as 'count.views',
                (select count(comment_id) from comments where comments.thread_id = threads.thread_id) as 'count.comments',
                threads.created_at,
                users.username,
                users.avatar_url
            from 
                threads
            inner join topics on threads.`topic_id` = topics.topic_id
            inner join users on threads.`creator_id` = users.user_id
            order by threads.created_at desc;
        ")->get();
    }

    /**
     * @param string $slug
     * @return Database|bool|\mysqli_result
     */
    public static function whereSlug(string $slug)
    {
        return Database::instance()->query("
            select 
                threads.thread_id,
                threads.title,
                threads.slug,
                threads.content,
                topics.title as 'topic.title',
                threads.views as 'count.views',
                (select count(comment_id) from comments where comments.thread_id = threads.thread_id) as 'count.comments',
                threads.created_at,
                users.username,
                users.avatar_url
            from 
                threads
            inner join topics on threads.`topic_id` = topics.topic_id
            inner join users on threads.`creator_id` = users.user_id
            where threads.slug = '{$slug}';
        ");
    }

    /**
     * @param $topic
     * @return Database|bool|\mysqli_result
     */
    public static function whereTopic($topic)
    {
        return Database::instance()->query("
            select 
                threads.thread_id,
                threads.title,
                threads.slug,
                threads.content,
                topics.title as 'topic.title',
                threads.views as 'count.views',
                (select count(comment_id) from comments where comments.thread_id = threads.thread_id) as 'count.comments',
                threads.created_at,
                users.username,
                users.avatar_url
            from 
                threads 
            inner join topics on threads.topic_id = topics.topic_id
            inner join users on threads.`creator_id` = users.user_id
            where topics.title = '{$topic}'
            order by threads.created_at desc;
        ");
    }

    /**
     * Get all the  threads from a current users username.
     *
     * @param $currentUser
     * @return Database|bool|\mysqli_result
     */
    public static function whereUsername(string $currentUser)
    {
        return Database::instance()->query("
            select
              users.username,
              topics.title as 'topic.title',
              threads.views as 'count.views',
              users.avatar_url,
              (select count(comment_id) from comments where comments.thread_id = threads.thread_id) as 'count.comments',
              threads.*
            from
              threads
            inner join  users on threads.creator_id = users.user_id
            inner join topics on threads.topic_id = topics.topic_id
            where users.username = '{$currentUser}';
        ");
    }
}