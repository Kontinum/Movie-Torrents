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
}
