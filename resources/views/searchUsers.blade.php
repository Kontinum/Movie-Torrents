@extends('layouts.app')

@section('content')
    <section style="background-color: aliceblue;">
        <div class="container">
            <div class="row">
                <h2>Search results for <strong>{{$search_term}}</strong> : {{count($users)}} results</h2>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Search users</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="GET" action="{{route('getSearchUsers')}}">


                            <div class="form-group{{ $errors->has('actor_name') ? ' has-error' : '' }}">
                                <label for="user_name" class="col-md-4 control-label">User name:</label>

                                <div class="col-md-6">
                                    <input id="user_name" type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" required autofocus>

                                    @if ($errors->has('user_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('actor_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Search users
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="container">
            <div class="row">
                <ul class="list-group col-md-12">

                    @foreach($users as $user)
                        <li style="float: left;height: 60px" class="list-group-item col-md-4 col-sm-6 col-xs-12">
                            <img style="width: 40px;height: 40px;border-radius: 50%" src="/images/users/{{$user->profile_picture}}" alt="{{$user->name}} image">
                            {{$user->name}}
                            <a style="line-height: 45px" class="pull-right" href="{{route('deleteUser',['user_id'=>$user->id])}}" title="Delete user"><i class="fa fa-lg fa-trash list-icons" aria-hidden="true"></i></a>

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection