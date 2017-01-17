<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function postComment(Request $request)
    {
        $this->validate($request, [
            'comment_body'=>'required|max:400'
        ]);

        $comment = new Comment();

        $comment->user_id = $request->user_id;
        $comment->movie_id = $request->movie_id;
        $comment->text = $request->comment_body;

        $comment->save();

        return redirect()->back()->with(['success'=>'Your comment has been successfully added']);
    }

    public function deleteComment($comment_id)
    {
        $comment = Comment::find($comment_id);

        if(!$comment){
            return back()->with(['fail'=>'Your comment has been already deleted']);
        }

        $comment->delete();

        return back()->with(['success'=>'Your comment has been successfully deleted']);
    }
}
