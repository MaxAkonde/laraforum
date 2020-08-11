<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Topic;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store (Topic $topic) {
        request()->validate([
            'content' => 'required|min:5'
        ]);

        $comment = new Comment();
        $comment->content = request('content');
        $comment->user_id = auth()->user()->id;

        $topic->comments()->save($comment);

        return redirect()->route('topics.show', $topic);
    }
}
