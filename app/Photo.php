<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = [
        'file'
    ];

    protected $uploads = '/img/';

    public function imageable()
    {
        return $this->morphTo('App\Photo', 'imageable');

    }

    // Accessor
    public function getFileAttribute($photo)
    {
        return asset('black').$this->uploads.$photo;
    }
}
