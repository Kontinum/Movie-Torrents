<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditMovieFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'movie_name'=>'required|max:100',
            'movie_year'=>'required|digits:4',
            'movie_director'=>'required|min:5|max:30|regex:/^[(a-zA-Z\s)]+$/u',
            'youtube_trailer'=>'required|url|youtube',
            'imdb_rating'=>'required|numeric',
            'movie_synopsis'=>'required|string',
            'genres'=>'required',
            'movie_actor_1'=>'required',
            'movie_actor_2'=>'required',
            'movie_actor_3'=>'required',
            'movie_actor_4'=>'required',
            'actor_1_role'=>'required|max:30|regex:/^[(a-zA-Z\s)]+$/u',
            'actor_2_role'=>'required|max:30|regex:/^[(a-zA-Z\s)]+$/u',
            'actor_3_role'=>'required|max:30|regex:/^[(a-zA-Z\s)]+$/u',
            'actor_4_role'=>'required|max:30|regex:/^[(a-zA-Z\s)]+$/u',
            'poster_image'=>'dimensions:min_width=280,min_height=410|mimes:jpg,jpeg,png',
            'screenshot1_image'=>'dimensions:min_width=1280,min_height=680|mimes:jpg,jpeg,png',
            'screenshot2_image'=>'dimensions:min_width=1280,min_height=680|mimes:jpg,jpeg,png',
            'movie_length'=>'required|string',
            'movie_size'=>'required|string',
            'movie_resolution'=>'required|string',
            'movie_audio'=>'required|alpha',
            'movie_fps'=>'required|numeric',
            'movie_pg'=>'required|string'
        ];
    }
}
