<?php

namespace App\Controllers;

use App\Models\Threads;

/**
 * Class ThreadsViewedController
 *
 * @package App\Controllers
 */
class HistoryController extends Controller
{
    /**
     * Get all the threads created by a specific username.
     */
    public function user() : void
    {
        $requestedUser = $this->request->get('username');

        $this->render('threads.index', [
            'threads' => Threads::whereUserHasViewed($requestedUser)->get()
        ]);
    }
}