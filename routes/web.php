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

    //Allows admin to add new actor and search them
    Route::get('/actors','ActorPagesController@getActors')->name('getActors');

    //Add new actor
    Route::post('/actors','ActorPagesController@postActor')->name('postActor');

    //Search actors
    Route::post('/actors/search','ActorPagesController@postSearchActors')->name('postSearchActors');

    //Search actors with A-Z letters
    Route::get('/actors/letter/{letter}','ActorPagesController@letterActors')->name('letterActors');

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

