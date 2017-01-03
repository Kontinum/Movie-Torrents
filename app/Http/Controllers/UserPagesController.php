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

        return redirect()->back()->with(['success'=>'User with name ' .$request['name'].' has been successfully added']);
    }

    //Return user profile
    public function getProfile($user_id)
    {
        $user = User::find($user_id);

        return view('profile')->with('user',$user);
    }

    //Search users
    public function getSearchUsers(Request $request)
    {
        $this->validate($request,[
            'user_name'=>'required|min:1|max:255'
        ]);
        $users = User::where('name','like', '%'. $request['user_name'].'%')->get();

        if($users->isEmpty()){
            return redirect()->back()->with(['fail'=>'There is no user with '.$request['user_name'].' search term']);
        }

        $search_term = $request['user_name'];

        return view('searchUsers')->with('users',$users)->with('search_term',$search_term);
    }

    //Delete user
    public function deleteUser($user_id)
    {
        $user = User::find($user_id);

        if(!$user){
            return redirect()->route('getUsers')->with(['fail'=>'That user is not in database']);
        }

        $user->delete();

        return redirect()->route('getUsers')->with(['success'=>'User '.$user->name.' has been successfully deleted']);
    }

    //Edit user information
    public function postEditUser(Request $request)
    {
        $this->validate($request,[
            'user_name'=>'required|max:255',
            'user_image'=>'dimensions:max_width=512,max_height=512|mimes:jpg,jpeg,png'
        ]);

        $user = User::find($request['user_id']);

        $user->name = $request['user_name'];

        if($request->hasFile('user_image')) {
            $user_image = $request->file('user_image');

            $filename = time() . '.' . $user_image->getClientOriginalName();

            if ($user->profile_picture !== 'user_default.png') {
                unlink(public_path() . '/images/users/' . $user->profile_picture);
            }

            $user_image->move('images/users/', $filename);
            $user->profile_picture = $filename;
        }

        $user->save();

        return redirect()->route('getProfile',['user_id'=>$user->id])->with(['success'=>'Your profile has been successfully updated']);

    }
}
