@extends('layouts.app')

@section('content')
    <section style="background-color: aliceblue;">
        <div class="container">
            <div class="row">
                <h2>Actors that name begin with letter: {{$letter}}</h2>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <ul class="list-group col-md-12">

                    @foreach($actors as $actor)
                        <li style="float: left;height: 60px" class="actor-list list-group-item col-md-4 col-sm-6 col-xs-12">
                            <img style="width: 40px;height: 40px;border-radius: 50%" src="/images/actors/{{$actor->thumbnail_path}}" alt="{{$actor->name}} image">
                            {{$actor->name}}
                            <a style="line-height: 45px" class="pull-right" href="{{route('deleteActor',['actor_id'=>$actor->id])}}" title="Delete actor"><i class="fa fa-lg fa-trash list-icons" aria-hidden="true"></i></a>
                            <i title="Edit actor" style="line-height:50px;cursor: pointer" class="fa fa-lg fa-pencil-square-o list-icons pull-right" aria-hidden="true"></i>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection