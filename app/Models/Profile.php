<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded=[];

    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : 'profile/0EO7X7LAPBQ9c5RwZvgG7zT0T5YrzanP29Gej4fG.webp';
        return '/storage/' . $imagePath;
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
