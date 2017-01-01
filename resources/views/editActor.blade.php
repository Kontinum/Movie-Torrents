@extends('layouts.app')

@section('content')
    <section style="background-color: aliceblue;">
        <div class="container">
            <div class="row">
                <h2>Edit actor: <strong>{{$actor->name}}</strong></h2>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div style="margin-top: 10px">
                <img class="actor-profile-img" src="/images/actors/{{$actor->thumbnail_path}}" alt="{{$actor->name}} image">
            </div>
        </div>
    </div>
@endsection