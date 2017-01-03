<?php

namespace App\Http\Controllers;

use App\Actor;
use Illuminate\Http\Request;

class ActorPagesController extends Controller
{
    //Return number of actors
    public function getActors()
    {
        $count_actors = Actor::all()->count();

        return view('actors')->with('count_actors',$count_actors);
    }

    //Add new actor
    public function postActor(Request $request)
    {
        $this->validate($request,[
            'actor'=>'required|min:5|max:30|regex:/^[(a-zA-Z\s)]+$/u',
            'birth_year'=>'required|numeric',
            'actor_image'=>'dimensions:max_width=256,max_height=256|mimes:jpg,jpeg,png'
        ]);

        $actor = Actor::where('name',$request['actor'])->where('birth_year',$request['birth_year'])->first();

        if($actor){
            return redirect()->route('getActors')->with(['fail'=>'Actor '.$actor->name.' is already in database']);
        }

        $actor = new Actor();
        $actor->name = $request['actor'];
        $actor->birth_year = $request['birth_year'];

        if($request->hasFile('actor_image')){
            $actor_image = $request->file('actor_image');
            $filename = time(). '.'. $actor_image->getClientOriginalName();
            $actor_image->move('images/actors/',$filename);

            $actor->actor_picture = $filename;
        }

        $actor->save();

        return redirect()->route('getActors')->with(['success'=>'Actor '.$request['actor'].' has been successfully added']);
    }

    //Delete actor
    public function deleteActor($actor_id)
    {
        $actor = Actor::find($actor_id);

        if(!$actor){
            return redirect()->route('getActors')->with(['fail'=>'That actor is not in database']);
        }

        //delete image with that filename is user doesn't have default image
        $filename = $actor->actor_picture;
        if($filename !== 'actor_default.png') {
            unlink(public_path() . '/images/actors/' . $filename);
        }
        $actor->delete();

        return redirect()->route('getActors')->with(['success'=>'Actor '.$actor->name.' has been successfully deleted']);

    }

    //Search actors
    public function getSearchActors(Request $request)
    {
        $this->validate($request,[
            'actor_name'=>'required|min:3|max:30|regex:/^[(a-zA-Z\s)]+$/u'
        ]);

        $actors = Actor::where('name','like', '%'.$request['actor_name'].'%')->get();

        if($actors->isEmpty()){
            return redirect()->back()->with(['fail'=>'There is no actors with '.$request['actor_name'].' search term']);
        }

        $search_term = $request['actor_name'];

        return view('searchActors')->with('actors',$actors)->with('search_term',$search_term);
    }

    //Return actors with a specific letter
    public function letterActors($letter)
    {
        $actors = Actor::where('name','like', $letter .'%')->get();

        if($actors->isEmpty()){
            return redirect()->route('getActors')->with(['fail'=>'There is no actors that name begin with letter: '.$letter]);
        }

        return view('letterActors')->with('actors',$actors)->with('letter',$letter);

    }

    //Return specific actor to edit
    public function getEditActor($actor_id)
    {
        $actor = Actor::find($actor_id);

        if(!$actor){
            return redirect()->back()->with(['fail'=>'There is no actor with that name in database']);
        }

        return view('editActor')->with('actor',$actor);
    }

    //Post edit actor
    public function postEditActor(Request $request)
    {
        $this->validate($request,[
            'actor_name'=>'required|min:5|max:30|regex:/^[(a-zA-Z\s)]+$/u',
            'actor_birth_year'=>'required|digits:4',
            'actor_image'=>'dimensions:max_width=256,max_height=256|mimes:jpg,jpeg,png'
        ]);

        $actor = Actor::find($request['actor_id']);

        $actor->name = $request['actor_name'];
        $actor->birth_year = $request['actor_birth_year'];

        if($request->hasFile('actor_image')){
            $actor_image = $request->file('actor_image');
            $filename = time() . '.' . $actor_image->getClientOriginalName();

            if($actor->actor_picture !== 'actor_default.png'){
                unlink(public_path().'/images/actors/'.$actor->actor_picture);
            }

            $actor_image->move('images/actors/',$filename);
            $actor->actor_picture = $filename;
        }

        $actor->save();

        return redirect()->back()->with(['success'=>'Actor '.$actor->name.' has been successfully edited']);
    }

}
