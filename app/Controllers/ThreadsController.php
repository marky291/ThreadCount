<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-02-27
 * Time: 17:16
 */

namespace App\Controllers;

use App\Exceptions\UnauthorizedException;
use App\Models\Comments;
use App\Models\Threads;
use App\Models\Topics;
use Carbon\Carbon;

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
            'threads' => Threads::all()
        ]);
    }

    /**
     * View a certain group of topics.
     */
    public function topic(): void
    {
        $topicTitle = $this->request->get('title');

        $this->render('threads.index', [
            'currentTopic' => $topicTitle,
            'threads' => Threads::whereTopicTitle($topicTitle)->get(),
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

        if (auth()->check()) {
            Threads::viewedByUserEvent($thread['thread_id'], auth()->user()->getId());
        }
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

    /**
     * Get the most popular threads, those with most comments.
     */
    public function popular() : void
    {
        $this->render('threads.index', [
            'threads' => Threads::whereMostCommented(Carbon::now()->startOfDecade())->get()
        ]);
    }

    /**
     * Get the most popular this week, also known as trending.
     * Popularity is determined by most comments on a thread.
     */
    public function trending() : void
    {
        $this->render('threads.index', [
            'threads' => Threads::whereMostCommented(Carbon::now()->subWeek())->get()
        ]);
    }

    /**
     * Fresh topics are those that do not have any replies made yet.
     */
    public function fresh() : void
    {
        $this->render('threads.index', [
            'threads' => Threads::whereHasNoComments()->get()
        ]);
    }

    /**
     * Get all the threads where they match a LIKE query.
     */
    public function search() : void
    {
        $query = $this->request->get('query');

        $this->render('threads.index', [
            'threads' => Threads::whereTitleLike($query)->get()
        ]);
    }

    /**
     * Delete a thread request.
     */
    public function destroy()
    {
        $this->gates(['auth', 'post']);

        $threadID = $this->request->post('threadID');

        Threads::deleteWhereID($threadID);
    }

    /**
     * Update/Edit an existing thread
     */
    public function update()
    {
        $this->gates(['auth']);

        if ($this->request->isGetMethod())
        {
            $thread = Threads::whereSlug($this->request->get('slug'))->first();
            $userOwnsComment = $thread['username'] == auth()->user()->getUsername();
            $userHasRole = auth()->user()->hasRole(['super', 'admin', 'moderator']);

            if ($userHasRole || $userOwnsComment)
            {
                $this->render('threads.create', ['thread' => $thread, 'topics' => Topics::all()]);
            }
            else
            {
                throw new UnauthorizedException('User can not edit this thread');
            }
        }

        $this->gates(['post']);

        $thread = Threads::whereSlug($this->request->post('threadSlug'))->first();

        $title = $this->request->post('title');
        $newSlug = str_slug($title);
        $content = $this->request->post('content');
        $topicID = $this->request->post('topicID');

        $userOwnsComment = $thread['username'] == auth()->user()->getUsername();

        $userHasRole = auth()->user()->hasRole(['super', 'admin', 'moderator']);

        if ($userHasRole || $userOwnsComment)
        {
            Threads::updateThreadWhereID($thread['thread_id'], $title, $newSlug, $content, $topicID);

            return redirect("threads/show?slug={$newSlug}");
        }

        throw new UnauthorizedException('User cannot edit this thread');
    }

    /**
     * Creation of a new thread.
     * Handles both get and post requests.
     */
    public function create()
    {
        $this->gates(['auth']);

        if ($this->request->isGetMethod())
        {
            return $this->render('threads.create', ['topics' => Topics::all()]);
        }

        $this->gates(['post']);

        Threads::saveFreshModel(
            auth()->user()->getId(),
            $this->request->post('topicID'),
            $this->request->post('title'),
            $this->request->post('content')
        );

        $slug = str_slug($this->request->post('title'));

        /**
         * Redirect to the homepage.
         */
        return redirect("/threads/show?slug={$slug}");
    }
}