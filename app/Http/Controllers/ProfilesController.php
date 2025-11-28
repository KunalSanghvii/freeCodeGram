<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index($user)
    {
        $user = User::findOrFail($user); #one way to do this
        return view('profiles.index',[
            'user' => $user,
        ]);
    }

    public function edit(User $user) #optimal way to do this
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));

    }

    public function update(User $user) #optimal way to do this
    {
       $data = request()->validate([
        'title' => 'required',
        'description' => 'required',
        'url' => 'url',
        'image' => '',
       ]);

       if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))
                                 ->resize(1200, null, function ($constraint) {
                                     $constraint->aspectRatio();
                                     $constraint->upsize();
                                 })
                                 ->resizeCanvas(1000, 1000, 'center', false, 'ffffff');
            $image->save();

            $imageArray = ['image' => $imagePath];
       }

    
       auth()->user()->profile->update(array_merge(
        $data,
        $imageArray ?? []
       ));

       return redirect("/profile/{$user->id}");

    }
}
