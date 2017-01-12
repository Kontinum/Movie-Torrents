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
            'movie_name'=>'max:100',
            'movie_year'=>'digits:4',
            'movie_director'=>'min:5|max:30|regex:/^[(a-zA-Z\s)]+$/u',
            'youtube_trailer'=>'url|youtube',
            'imdb_rating'=>'numeric',
            'movie_synopsis'=>'string',
            'genres[]'=>'',
            'movie_actor_1'=>'',
            'movie_actor_2'=>'',
            'movie_actor_3'=>'',
            'movie_actor_4'=>'',
            'actor_1_role'=>'max:30|regex:/^[(a-zA-Z\s)]+$/u',
            'actor_2_role'=>'max:30|regex:/^[(a-zA-Z\s)]+$/u',
            'actor_3_role'=>'max:30|regex:/^[(a-zA-Z\s)]+$/u',
            'actor_4_role'=>'max:30|regex:/^[(a-zA-Z\s)]+$/u',
            'poster_image'=>'dimensions:min_width=280,min_height=410|mimes:jpg,jpeg,png',
            'screenshot1_image'=>'dimensions:min_width=1280,min_height=680|mimes:jpg,jpeg,png',
            'screenshot2_image'=>'dimensions:min_width=1280,min_height=680|mimes:jpg,jpeg,png',
            'movie_length'=>'string',
            'movie_size'=>'string',
            'movie_resolution'=>'string',
            'movie_audio'=>'alpha',
            'movie_fps'=>'numeric',
            'movie_pg'=>'string'
        ];
    }
}
