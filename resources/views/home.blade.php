@extends('layouts.app')

@section('content')

    <div class="jumbotron">
        <div class="container">
            <h1 class="text-center">1080p HD Movies</h1>
            <h3 class="text-center">Download fast movies with HD quality</h3>
        </div>
    </div>
    <section class="popular-movies-section">
        <div class="container">
            <div class="row">
                <h2><i class="fa fa-film" aria-hidden="true"></i>Popular movies</h2>
                <hr>
            </div>
            <div class="row">
                <div class="col-lg-3 col-lg-offset-0 col-md-5 col-md-offset-1 col-sm-5 col-sm-offset-1 col-xs-12 col-xs-offset-0 ">
                    <div class="movie">
                        <a href="#" class="movie-link">
                            <figure>
                                <img class="img-responsive image-list" src="/images/ipman.jpg" alt="ipman">
                                <figcaption class="hidden-sm hidden-xs">
                                    <br><br><br><br>
                                    <h4 class="rating">7 / 10</h4>
                                    <h4>Action</h4>
                                    <h4>Biography</h4>
                                </figcaption>
                            </figure>
                        </a>
                        <div class="movie-bottom">
                            <a href="#" class="movie-link-name">Ip Man</a>
                            <div class="movie-year">2010</div>
                            <a href="#" class="movie-link-download">
                                <i class="fa fa-2x fa-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="background-color: aliceblue" class="new-movies-section">
        <div class="container">
            <div class="row">
                <h2><i class="fa fa-film" aria-hidden="true"></i>New Movies</h2>
                <hr>
            </div>
            <div class="row">
                <div class="col-lg-3 col-lg-offset-0 col-md-5 col-md-offset-1 col-sm-5 col-sm-offset-1 col-xs-12 col-xs-offset-0 ">
                    <div class="movie">
                        <a href="#" class="movie-link">
                            <figure>
                                <img class="img-responsive image-list" src="/images/ipman.jpg" alt="ipman">
                                <figcaption class="hidden-sm hidden-xs">
                                    <br><br><br><br>
                                    <h4 class="rating">7 / 10</h4>
                                    <h4>Action</h4>
                                    <h4>Biography</h4>
                                </figcaption>
                            </figure>
                        </a>
                        <div class="movie-bottom">
                            <a href="#" class="movie-link-name">Ip Man</a>
                            <div class="movie-year">2010</div>
                            <a href="#" class="movie-link-download">
                                <i class="fa fa-2x fa-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
