@extends('layouts.app')

@section('content')
    <section style="background-color: aliceblue;">
        <div class="container">
            <h2>Number of movies: {{($count_movies == 0) ? 'There are no movies in database' : '<strong>'.$count_movies.'</strong>'}}</h2>
        </div>
    </section>
@endsection