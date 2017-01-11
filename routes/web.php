<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Auth::routes();

//Admin routes
Route::group(
    ['prefix'=>'admin','middleware'=>'auth'],function(){

    //Alows admin to add new user, seach and delete them
    Route::get('/users','UserPagesController@getUsers')->name('getUsers');

    //Add new user
    Route::post('/users','UserPagesController@postUser')->name('postUser');

    //Search users
    Route::get('/users/search','UserPagesController@getSearchUsers')->name('getSearchUsers');

    //Delete user
    Route::get('/user/{user_id}/delete','UserPagesController@deleteUser')->name('deleteUser');

    //Movies
    Route::get('/movies','MoviePagesController@getMovies')->name('getMovies');

    //Add movie
    Route::post('/movies','MoviePagesController@postMovie')->name('postMovie');

    //Search movies
    Route::get('/movies/search','MoviePagesController@getSearchMovies')->name('getSearchMovies');

    //Delete movie
    Route::get('/movie/{movie_id}/delete','MoviePagesController@deleteMovie')->name('deleteMovie');

    //Movies by letter
    Route::get('/movies/letter/{letter}','MoviePagesController@letterMovies')->name('letterMovies');

    //Edit movie
    Route::get('/movie/{movie_id}/edit','MoviePagesController@getEditMovie')->name('getEditMovie');

    //Allows admin to add new actor and search them
    Route::get('/actors','ActorPagesController@getActors')->name('getActors');

    //Add new actor
    Route::post('/actors','ActorPagesController@postActor')->name('postActor');

    //Search actors
    Route::get('/actors/search','ActorPagesController@getSearchActors')->name('getSearchActors');

    //Search actors with A-Z letters
    Route::get('/actors/letter/{letter}','ActorPagesController@letterActors')->name('letterActors');

    //Allows admin to edit actor
    Route::get('/actor/{actor_id}/edit','ActorPagesController@getEditActor')->name('getEditActor');

    //Edit actor
    Route::post('/actor/edit','ActorPagesController@postEditActor')->name('postEditActor');

    //Delete actor
    Route::get('/actor/{actor_id}/delete','ActorPagesController@deleteActor')->name('deleteActor');

    //Allows admin to add genre, see all genres, edit or delete them
    Route::get('/genres','GenrePagesController@getGenres')->name('getGenres');

    //Allows admin to add new genre
    Route::post('/genres','GenrePagesController@postGenre')->name('postGenre');

    //Delete genre
    Route::get('/genre/{genre_id}/delete','GenrePagesController@deleteGenre')->name('deleteGenre');

    //Edit genre
    Route::post('/genre/{genre_id}/edit','GenrePagesController@postEditGenre')->name('postEditGenre');
}
);

//Edit user information
Route::post('/user/edit','UserPagesController@postEditUser')->name('postEditUser');

//Allows user to change profile picture and username
Route::get('/user/{user_id}/profile','UserPagesController@getProfile')->name('getProfile');

