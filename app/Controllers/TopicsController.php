<?php


namespace App\Controllers;


use App\Models\Threads;
use App\Models\Topics;

class TopicsController extends Controller
{
    public function destroy()
    {
        $this->gates(['auth', 'admin', 'post']);

        $topic_id = $this->request->post('topicID');

        $threads = Threads::whereTopicID($topic_id)->get();

        $stored_ids = [];

        // remove threads before we remove the topic.
        foreach ($threads as $thread)
        {
            $stored_ids[] = $thread['thread_id'];
        }

        // delete all threads with the parsed IDs
        Threads::deleteManyIDs($stored_ids);

        // we can only delete topics with no threads.
        Topics::deleteWhereID($topic_id);

        // response
        return json_encode(['status' => true]);
    }

    public function create()
    {
        $this->gates(['auth', 'admin']);

        if ($this->request->isGetMethod())
        {
            return $this->render('topics.create');
        }

        $this->gates(['post']);

        Topics::saveFreshModel(
            auth()->user()->getId(),
            $this->request->post('name'),
            $this->request->post('description')
        );

        return redirect('/');
    }
}