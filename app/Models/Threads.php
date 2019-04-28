<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-09
 * Time: 17:42
 */

namespace App\Models;

use App\Classes\Database;
use App\Exceptions\Exception;
use Carbon\Carbon;

/**
 * Class Threads
 *
 * @package App\Models
 */
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
                (select count(thread_id) from user_viewed_threads uvt where uvt.thread_id = threads.thread_id) as 'count.user.views',
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
                (select count(thread_id) from user_viewed_threads uvt where uvt.thread_id = threads.thread_id) as 'count.user.views',
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
    public static function whereTopicTitle($topic)
    {
        return Database::instance()->query("
            select 
                threads.thread_id,
                threads.title,
                threads.slug,
                threads.content,
                topics.title as 'topic.title',
                (select count(thread_id) from user_viewed_threads uvt where uvt.thread_id = threads.thread_id) as 'count.user.views',
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

    public static function whereTopicID(int $identifier)
    {
        return Database::instance()->query("
            select 
                threads.thread_id,
                threads.title,
                threads.slug,
                threads.content,
                topics.title as 'topic.title',
                (select count(thread_id) from user_viewed_threads uvt where uvt.thread_id = threads.thread_id) as 'count.user.views',
                (select count(comment_id) from comments where comments.thread_id = threads.thread_id) as 'count.comments',
                threads.created_at,
                users.username,
                users.avatar_url
            from 
                threads 
            inner join topics on threads.topic_id = topics.topic_id
            inner join users on threads.`creator_id` = users.user_id
            where topics.topic_id = '{$identifier}'
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
              (select count(thread_id) from user_viewed_threads uvt where uvt.thread_id = threads.thread_id) as 'count.user.views',
              users.avatar_url,
              (select count(comment_id) from comments where comments.thread_id = threads.thread_id) as 'count.comments',
              threads.*
            from
              threads
            inner join  users on threads.creator_id = users.user_id
            inner join topics on threads.topic_id = topics.topic_id
            where users.username = '{$currentUser}'
            order by threads.created_at desc;
        ");
    }

    public static function whereTitleLike(string $query)
    {
        return Database::instance()->query("
            select
              threads.thread_id,
              threads.title,
              threads.slug,
              threads.content,
              topics.title as 'topic.title',
              (select count(thread_id) from user_viewed_threads uvt where uvt.thread_id = threads.thread_id) as 'count.user.views',
              (select count(comment_id) from comments where comments.thread_id = threads.thread_id) as 'count.comments',
              threads.created_at,
              users.username,
              users.avatar_url
            from
              threads
                inner join topics on threads.topic_id = topics.topic_id
                inner join users on threads.`creator_id` = users.user_id
            where
              threads.title like '%{$query}%';
        ");
    }

    /**
     * @param int $userID
     * @return Database
     */
    public static function collectAllViewedBy(int $userID) : Database
    {
        return Database::instance()->query("
            select thread_id from user_viewed_threads uvt where uvt.user_id = '{$userID}';
        ");
    }

    /**
     * @param string $username
     * @return Database|bool|mixed|\mysqli_result
     */
    public static function whereUserHasViewed(string $username)
    {
        return Database::instance()->query("
            select
                threads.thread_id,
                threads.title,
                threads.slug,
                threads.content,
                topics.title as 'topic.title',
                (select count(thread_id) from user_viewed_threads uvt where uvt.thread_id = threads.thread_id) as 'count.user.views',
                (select count(comment_id) from comments where comments.thread_id = threads.thread_id) as 'count.comments',
                threads.created_at,
                users.username,
                users.avatar_url
            from user_viewed_threads
            inner join threads on user_viewed_threads.thread_id = threads.thread_id
            inner join users on user_viewed_threads.user_id = users.user_id
            inner join topics on threads.topic_id = topics.topic_id
            where users.username = '{$username}'
            order by threads.created_at desc;
        ");
    }

    public static function whereMostCommented(Carbon $starting_date)
    {
        return Database::instance()->query("
            select
              threads.thread_id,
              threads.title,
              threads.slug,
              threads.content,
              topics.title as 'topic.title',
              (select count(thread_id) from user_viewed_threads uvt where uvt.thread_id = threads.thread_id) as 'count.user.views',
              (select count(comment_id) from comments where comments.thread_id = threads.thread_id) as 'count.comments',
              threads.created_at,
              users.username,
              users.avatar_url
            from
              threads
                inner join topics on threads.`topic_id` = topics.topic_id
                inner join users on threads.`creator_id` = users.user_id
            where
                threads.created_at >= '{$starting_date->toDateTimeString()}'
            order by `count.comments` desc
        ");
    }

    public static function whereHasNoComments()
    {
        return Database::instance()->query("
            select
              threads.thread_id,
              threads.title,
              threads.slug,
              threads.content,
              topics.title as 'topic.title',
              (select count(thread_id) from user_viewed_threads uvt where uvt.thread_id = threads.thread_id) as 'count.user.views',
              (select count(comment_id) from comments where comments.thread_id = threads.thread_id) as 'count.comments',
              threads.created_at,
              users.username,
              users.avatar_url
            from
              threads
                inner join topics on threads.`topic_id` = topics.topic_id
                inner join users on threads.`creator_id` = users.user_id
            having
                `count.comments` = 0
            order by threads.created_at desc
        ");
    }

    /**
     * Locate a thread where its ID matches a value integer
     *
     * @param int $identifier
     * @return Database|bool|mixed|\mysqli_result
     */
    public static function whereID(int $identifier)
    {
        return Database::instance()->query("
            select 
                threads.thread_id,
                threads.title,
                threads.slug,
                threads.content,
                topics.title as 'topic.title',
                (select count(thread_id) from user_viewed_threads uvt where uvt.thread_id = threads.thread_id) as 'count.user.views',
                (select count(comment_id) from comments where comments.thread_id = threads.thread_id) as 'count.comments',
                threads.created_at,
                users.username,
                users.avatar_url
            from 
                threads
            inner join topics on threads.`topic_id` = topics.topic_id
            inner join users on threads.`creator_id` = users.user_id
            where threads.thread_id = '{$identifier}';
        ");
    }

    /**
     * Save a newly made, fresh model.
     *
     * @param int $creator_id
     * @param int $topic_id
     * @param string $content
     * @return Database|bool|mixed|\mysqli_result
     */
    public static function saveFreshModel(int $creator_id, int $topic_id, string $title, string $content)
    {
        $slug = str_slug($title);

        return Database::instance()->query("
            insert into threads 
                (creator_id, topic_id, title, content, slug) 
            values 
               ('{$creator_id}', '{$topic_id}', '{$title}', '{$content}', '{$slug}');
        ");
    }

    /**
     * Delete a single ID.
     *
     * @param $thread_id
     * @return Database|bool|mixed|\mysqli_result
     */
    public static function deleteWhereID($thread_id)
    {
        return self::deleteManyIDs(array($thread_id));
    }

    /**
     * Delete many IDs from the database.
     *
     * @param $stored_ids
     * @return Database|bool|mixed|\mysqli_result
     */
    public static function deleteManyIDs($stored_ids)
    {
        $values = implode("','", $stored_ids);

        Database::instance()->query("
            delete from user_viewed_threads where thread_id in ('{$values}');
        ");

        Database::instance()->query("
            delete from comments where thread_id in ('{$values}');
        ");

        return Database::instance()->query("
            delete from threads where thread_id in ('{$values}');
        ");
    }

    public static function viewedByUserEvent(int $thread_id, int $user_id): void
    {
        // check if the user has viewed this thread before.
        // return 1 if they have, 0 if they have not.
        if (!Database::instance()->query("select 1 from user_viewed_threads uvt where uvt.thread_id = '{$thread_id}' and uvt.user_id = '{$user_id}'")->count())
        {
            // user never viewed the thread so lets store the view.
            Database::instance()->query("insert into user_viewed_threads (thread_id, user_id) values ('{$thread_id}', '{$user_id}')");
        }
    }

    public static function updateThreadWhereID($thread_id, string $title, string $slug, string $content, string $topicID)
    {
        return Database::instance()->query("
            update threads set 
                title = '{$title}',
                slug = '{$slug}',
                content = '{$content}', 
                topic_id = '{$topicID}'
            where thread_id = '{$thread_id}';
        ");
    }
}
