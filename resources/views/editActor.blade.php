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
            <div class="col-md-4 col-sm-6 col-xs-12">
                <img class="actor-profile-img" src="/images/actors/{{$actor->thumbnail_path}}" alt="{{$actor->name}} image">
            </div>
            <div class=" edit-actor-form col-md-8 col-sm-6 col-xs-12">
                <form class="edit-actor-form" action="{{route('postEditActor')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="actor_id" value="{{$actor->id}}">
                   <div class="form-group">
                       <label for="actor_name" class="control-label">Name:</label>
                       <input class="form-control" id="actor_name"  type="text" name="actor_name" value="{{$actor->name}}" required>
                   </div>
                    <div class="form-group">
                        <label for="actor_birth_year" class="control-label">Birth year:</label>
                        <input class="form-control" id="actor_birth_year"  type="text" name="actor_birth_year" value="{{$actor->birth_year}}" required>
                    </div>
                    <div class="form-group">
                        <label for="actor_image" class="control-label">Actor image(256x256):</label>
                        <input class="form-control" id="actor_image" type="file"  name="actor_image">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary pull-right" type="submit" value="Edit actor">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection