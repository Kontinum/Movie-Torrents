<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserPagesController extends Controller
{
    //Return number of users and allow admin to add new user,search and delete them
    public function getUsers()
    {
        $count_users = User::all()->count();

        return view('users')->with('count_users',$count_users);
    }

    //Add new user
    public function postUser(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return redirect()->back()->with(['success'=>'User with name ' .$request['name'].' successfully added']);
    }
}
