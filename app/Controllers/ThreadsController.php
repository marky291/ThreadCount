<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-02-27
 * Time: 17:16
 */

namespace App\Controllers;

use App\Models\Comments;
use App\Models\Roles;
use App\Models\Threads;
use App\Models\Topics;

/**
 * Class HomeController
 *
 * @package App\Controllers
 */
class ThreadsController extends Controller
{
    /**
     * This is the main page of the website.
     *
     * View a list of all topics.
     */
    public function index()
    {
        $this->render('threads.index', [
            'threads' => Threads::all(),
        ]);
    }

    /**
     * View a certain group of topics.
     */
    public function topic()
    {
        $topicTitle = $this->request->get('title');

        $this->render('threads.index', [
            'currentTopic' => $topicTitle,
            'threads' => Threads::whereTopic($topicTitle)->get(),
        ]);
    }

    /**
     * Show a specific thread on the page by its slug
     */
    public function show(): void
    {
        $currentSlug = $this->request->get('slug');

        $thread = Threads::whereSlug($currentSlug)->first();

        $this->render('threads.show', [
            'thread' => $thread,
            'comments' => Comments::whereThreadID($thread['thread_id'])->get()
        ]);
    }

    /**
     * Get all the threads created by a specific username.
     */
    public function user() : void
    {
        $currentUser = $this->request->get('username');

        $this->render('threads.index', [
            'threads' => Threads::whereUsername($currentUser)->get()
        ]);
    }
}