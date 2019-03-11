<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 2019-02-27
 * Time: 17:16
 */

namespace App\Controllers;

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
        $currentTopic = $this->request->get('topic');

        $this->render('threads.index', [
            'topics' => Topics::all(),
            'currentTopic' => $currentTopic,
            'threads' => Threads::whereTopic($currentTopic),
        ]);
    }

    public function view()
    {
        $this->render('threads.index', ['variable' => 'HomeController@show']);
    }
}