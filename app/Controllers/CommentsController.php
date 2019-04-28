<?php


namespace App\Controllers;

use App\Models\Comments;

/**
 * Class CommentsController
 *
 * @package App\Controllers
 */
class CommentsController extends Controller
{

    public function user()
    {
        $comments = Comments::whereUserUsername($this->request->get('username'))->get();

        $this->render('comments.index', ['comments' => $comments]);
    }

    public function store()
    {
        $this->gates(['auth', 'post']);

        $status = Comments::saveFreshModel(
            auth()->user()->getId(),
            $this->request->post('threadID'),
            $this->request->post('commentText')
        );

        return $this->respondWithJson(['status' => $status]);
    }

    public function destroy()
    {
        $this->gates(['auth', 'post']);

        $commentID = $this->request->post('commentID');

        $comment = Comments::whereID($this->request->post('commentID'))->first();

        $userOwnsComment = $comment['user.user_id'] == auth()->user()->getId();
        $userHasRole = auth()->user()->hasRole(['super', 'admin', 'moderator']);

        if ($userHasRole || $userOwnsComment)
        {
            $status = Comments::deleteWhereID($commentID);

            return json_encode(['status' => $status]);
        }
    }
}