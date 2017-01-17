@extends('layouts.app')

@section('content')
    <section style="background-color: aliceblue;">
        <div class="container">
            <h2>Comments for <strong>{{$movie->name}}</strong></h2>
        </div>
    </section>
    <div class="container">
        <div class="row">
            @if(!Auth::check())
                Please <a href="{{route('login')}}">login</a> in order to post a comment.
            @else
                <div class="col-lg-8 col-lg-offset-2">
                    <form class="form-horizontal" action="{{route('postComment')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="movie_id" value="{{$movie->id}}">
                        <input type="hidden" name="user_id" value="{{Auth::id()}}">
                        <div class="form-group">
                            <label class="control-label" for="comment_body">Post a comment (max 400)</label>
                            <textarea class="form-control" name="comment_body" id="comment_body" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Post a comment</button>
                        </div>
                    </form>
                </div>
            @endif
            @foreach($comments as $comment)
                <div class="browse-movie-comment col-lg-12">
                    <div class="col-lg-4">{{$comment->user->name}}
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-1">
                            <img width="50px" height="50px" style="border-radius: 50%" src="/images/users/{{$comment->user->profile_picture}}" alt="">
                        </div>
                        <div class="col-lg-8">
                            <strong class="browse-movie-comment-text">{{$comment->text}}</strong>
                            <br> <i>{{$comment->created_at}}</i>
                        </div>
                        <div class="col-lg-1">
                            @if($comment->user_id == Auth::id())
                                <a title="Delete your comment" href="{{route('deleteComment',['comment_id'=>$comment->id])}}"><i class="pull-right fa fa-lg fa-times" aria-hidden="true"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
                <hr class="col-lg-6 col-lg-offset-2">
            @endforeach
        </div>
    </div>
@endsection