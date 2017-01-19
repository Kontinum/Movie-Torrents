@extends('layouts.app')

@section('content')
    <section style="background-color: aliceblue;">
        <div class="container">
                <h2>Actors that name begin with letter: <strong>{{$letter}}</strong></h2>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <ul class="list-group col-md-12">

                    @foreach($actors as $actor)
                        <li style="float: left;height: 60px" class="actor-list list-group-item col-md-4 col-sm-6 col-xs-12">
                            <img style="width: 40px;height: 40px;border-radius: 50%" src="/images/actors/{{$actor->actor_picture}}" alt="{{$actor->name}} image">
                            {{$actor->name}}
                            <a style="line-height: 45px" class="pull-right" href="{{route('deleteActor',['actor_id'=>$actor->id])}}" title="Delete actor">
                                <i class="fa fa-lg fa-trash list-icons" aria-hidden="true"></i>
                            </a>
                            <a href="{{route('getEditActor',['actor_id'=>$actor->id])}}" title="Edit actor">
                                <i style="line-height:50px;" class="fa fa-lg fa-pencil-square-o list-icons pull-right" aria-hidden="true"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection