<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Intervention\Image\Facades\Image;



class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('posts/create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image']
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))
                             ->resize(1200, null, function ($constraint) {
                                 $constraint->aspectRatio();
                                 $constraint->upsize();
                             })
                             ->resizeCanvas(1200, 1200, 'center', false, 'ffffff');
        $image->save();

        auth()->user()->posts()->create([
               'caption' => $data['caption'],
               'image' => $imagePath,
            ]);

        return redirect('/profile/'. auth()->user()->id);

    }

    public function show(\App\Models\Post $post)
    {
        return view('posts.show',compact('post'));
    }
}
