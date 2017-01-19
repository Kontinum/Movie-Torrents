@extends('layouts.app')

@section('content')
    <section style="background-color: aliceblue;">
        <div class="container">
            <h2><strong>{{$genre->name}}</strong> movies - {{$movies->total()}}</h2>
        </div>
    </section>
    @include('/partials/browseMovies')
@endsection