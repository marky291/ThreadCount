<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-03-09
 * Time: 17:42
 */

namespace App\Models;


use App\Classes\DB;

class Threads
{
    public static function all()
    {
        return DB::instance()->query('select * from threads');
    }

    public static function whereTopic($topic)
    {
        return DB::instance()->query("
            select 
                threads.title,
                threads.slug,
                threads.content,
                topics.title as 'topic.title',
                threads.views as 'count.views',
                (select count(reply_id) from comments where comments.thread_id = threads.thread_id) as 'count.comments',
                threads.created_at,
                users.username,
                users.avatar_url
            from 
                threads 
            inner join topics on topics.title = '{$topic}' 
            inner join users on threads.`creator_id` = users.user_id;
        ");
    }
}