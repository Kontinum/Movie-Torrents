@extends('layouts.app')

@section('content')
    <section style="background-color: aliceblue;">
        <div class="container">
                <h2><strong>{{$user->name}}</strong> profile</h2>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <img width="256" height="256" class="actor-profile-img" src="/images/users/{{$user->profile_picture}}" alt="{{$user->name}} image">
            </div>
            <div class=" edit-actor-form col-md-8 col-sm-6 col-xs-12">
                <form class="edit-actor-form" action="{{route('postEditUser')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <div class="form-group">
                        <label for="user_name" class="control-label">Change name:</label>
                        <input class="form-control" id="user_name"  type="text" name="user_name" value="{{$user->name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="user_image" class="control-label">Change profile image(512x512):</label>
                        <input class="form-control" id="user_image" type="file"  name="user_image">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary pull-right" type="submit" value="Update profile">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection