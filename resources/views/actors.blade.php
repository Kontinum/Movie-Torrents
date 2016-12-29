@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Actor</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('postGenre') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('actor') ? ' has-error' : '' }}">
                                <label for="actor" class="col-md-4 control-label">Actor name:</label>

                                <div class="col-md-6">
                                    <input id="actor" type="text" class="form-control" name="actor" value="{{ old('actor') }}" required autofocus>

                                    @if ($errors->has('actor'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('actor') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add actor
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section style="background-color: aliceblue;">
        <div class="container">
            <div class="row">
                <h2>List of actors:</h2>
                <hr>
                <ul class="list-group col-md-12">
                    @if(count($actors) == 0)
                        <p>The are no actors in database</p>
                    @else
                        @foreach($actors as $actor)

                            <li style="float: left;height: 60px" class="actor-list list-group-item col-md-4 col-sm-6 col-xs-12">
                                <img style="width: 40px;height: 40px;border-radius: 50%" src="/images/actors/{{$actor->thumbnail_path}}" alt="{{$actor->name}} image">
                                {{$actor->name}}
                                <a style="line-height: 45px" class="pull-right" href="#" title="Delete actor"><i class="fa fa-lg fa-trash list-icons" aria-hidden="true"></i></a>
                                <i title="Edit actor" style="line-height:50px;cursor: pointer" class="fa fa-lg fa-pencil-square-o list-icons pull-right" aria-hidden="true"></i>
                            </li>

                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </section>
@endsection