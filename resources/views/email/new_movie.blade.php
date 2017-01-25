<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New movie!!!</title>
</head>
<body>
<h2>New movie has been added! :) </h2>
<img src="/images/movies/{{$movie->pictures->images_directory_name.'/'.$movie->pictures->poster_picture}}" alt="">
<h5>Name: {{$movie->name}}</h5>
<h5>Year: {{$movie->year}}</h5>
<a href="{{route('browseMovies',['movie_id'=>$movie->id])}}">Open in a browser</a>
</body>
</html>