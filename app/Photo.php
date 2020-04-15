<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Photo extends Model
{
    //
    protected $fillable = [
        'file'
    ];

    public function imageable()
    {
        return $this->morphTo('App\Photo', 'imageable');

    }

    // Method is delete Photo from server i:e from the public directory
    public static function deletePhoto($photo)
    {
        return public_path('black/img/'.$photo);
    }
}
