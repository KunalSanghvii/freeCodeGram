<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index($user)
    {
        $user = User::findOrFail($user); #one way to do this
        return view('profiles.index',[
            'user' => $user,
        ]);
    }

    public function edit(\App\User $user) #optimal way to do this
    {
        $user = User::findOrFail($user);
        return view('profiles.index',[
            'user' => $user,
        ]);
    }
}
