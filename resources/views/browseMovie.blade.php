@extends('layouts.app')

@section('content')
    <div class="browse-movie-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <img class="browse-movie-poster img-responsive" src="/images/movies/{{$movie->name.'-'.$movie->year.'/'.$movie->pictures->poster_picture}}" alt="{{$movie->name}} poster picture">
                </div>
                <div class="col-lg-5">
                    <h1 class="browse-movie-name">{{$movie->name}}</h1><br><br>
                    <h3 class="browse-movie-year"><span class="browse-movie-normal">Year:</span> {{$movie->year}}</h3>
                    <h3 class="browse-movie-genres"><span class="browse-movie-normal">Genres:</span> {{$genres_string}}</h3>
                    <h3 class="browse-movie-genres"><span class="browse-movie-normal">Director:</span> {{$movie->director}}</h3>
                    <br><br>
                    <h3 class="browse-movie-rating"><span class="browse-movie-normal">Rating:</span> {{$movie->imdb_rating}} <i class="browse-movie-star fa fa-star" aria-hidden="true"></i></h3><br><br>
                    <a href="{{route('downloadTorrent',["movie_id"=>$movie->id])}}"><button class="btn btn-primary">Download Torrent &nbsp;&nbsp;<i class="fa fa-lg fa-download" aria-hidden="true"></i></button></a>
                </div>
                <div class="col-lg-3">
                    Movie recomendation
                </div>
            </div>
        </div>
        <div class="browse-movie-screenshots">
            <div class="container">
                <div class="row">
                    <div class="screenshots col-lg-4">
                        <iframe class="browse-movie-youtube" src="{{$movie->youtube_trailer}}" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="screenshots col-lg-4">
                        <a href="/images/movies/{{$movie->name.'-'.$movie->year.'/'.$movie->pictures->screenshot1}}" data-lightbox="screenshot" title="Click for larger image">
                            <img class="browse-movies-screenshot img-responsive" src="/images/movies/{{$movie->name.'-'.$movie->year.'/'.$movie->pictures->screenshot1}}" alt="{{$movie->name}} screenshoot 1">
                        </a>
                    </div>
                    <div class="screenshots col-lg-4">
                        <a href="/images/movies/{{$movie->name.'-'.$movie->year.'/'.$movie->pictures->screenshot2}}" data-lightbox="screenshot" title="Click for larger image">
                            <img class="browse-movies-screenshot img-responsive" src="/images/movies/{{$movie->name.'-'.$movie->year.'/'.$movie->pictures->screenshot2}}" alt="{{$movie->name}} screenshoot 1">
                        </a>
                    </div>
                    <hr class="col-lg-12">
                </div>
            </div>
        </div>
    </div>
    <div class="browse-movie-info-and-actors">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Synopsis:</h3>
                    <p>{{$movie->synopsis}}</p>
                    <h3>Movie info:</h3>
                    <div class="row">
                        <div class="col-lg-3 col-lg-offset-1">
                            <h4><i class="browse-movie-info-icon fa fa-lg fa-film" aria-hidden="true"></i> {{$movie->torrent->length}}</h4>
                        </div>
                        <div class="col-lg-3 col-lg-offset-1">
                            <h4><i class="browse-movie-info-icon fa fa-lg fa-file-video-o" aria-hidden="true"></i> {{$movie->torrent->size}}</h4>
                        </div>
                        <div class="col-lg-3 col-lg-offset-1">
                            <h4><i class="browse-movie-info-icon fa fa-lg fa-arrows-alt" aria-hidden="true"></i> {{$movie->torrent->resolution}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-lg-offset-1"><h4><i class="browse-movie-info-icon fa fa-lg fa-volume-up" aria-hidden="true"></i> {{$movie->torrent->audio}}</h4></div>
                        <div class="col-lg-3 col-lg-offset-1"><h4><i class="browse-movie-info-icon fa fa-lg fa-television" aria-hidden="true"></i> {{$movie->torrent->fps}} fps</h4></div>
                        <div class="col-lg-3 col-lg-offset-1"><h4><i class="browse-movie-info-icon fa fa-lg fa-eye" aria-hidden="true"></i> {{$movie->torrent->pg}}</h4></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-lg-offset-1"><h4><i class="browse-movie-info-icon fa fa-lg fa-calendar" aria-hidden="true"></i> {{$movie->created_at}}</h4></div>
                        <div class="col-lg-3 col-lg-offset-1"><h4><i class="browse-movie-info-icon fa fa-lg fa-download" aria-hidden="true"></i> {{$movie->downloaded}}</h4></div>
                        <div class="col-lg-3 col-lg-offset-1"><h4><i class="browse-movie-info-icon fa fa-lg fa-battery-half" aria-hidden="true"></i> {{$movie->torrent->peer_seed}}</h4></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h3>Actors:</h3>
                    @foreach($movie->actors as $actor)
                        <div class="browse-movie-actor">
                            <img style="width: 50px;height: 50px;border-radius: 50%" src="/images/actors/{{$actor->actor_picture}}" alt="">&nbsp;
                            <span class="browse-movie-actor-name">{{$actor->name}}</span> as <span class="browse-movie-actor-name">{{$actor->pivot->plays}}</span>
                        </div>
                    @endforeach
                </div>
                <hr class="col-lg-12">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h3>Comments:</h3>
            <div class="browse-movie-comments">
                @if(count($comments) == 0)
                    <p>There are no comments for this movie. Add one!</p>
                @else
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
                    @endforeach
                @endif
                @if(count($comments) == 5)
                        <div class="col-lg-12 text-center">
                            <a href="{{route('allComments',['movie_id'=>$movie->id])}}"><button type="button" class="btn btn-primary">See all</button></a>
                        </div>
                @endif
            </div>
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
        </div>
    </div>
@endsection
@section('script')
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'positionFromTop' : 100
        })
    </script>
    @endsection