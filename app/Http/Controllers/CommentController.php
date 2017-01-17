<?php

namespace App\Http\Controllers;

use App\Movie;
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

    //see all coments for a specific movie
    public function allComments($movie_id)
    {
        $comments = Comment::where('movie_id',$movie_id)->orderBy('created_at','DESC')->get();

        $movie = Movie::find($movie_id);

        return view('allComments')->with('comments',$comments)->with('movie',$movie);
    }
}
