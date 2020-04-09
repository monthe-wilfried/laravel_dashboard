<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publication extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'title', 'content', 'author', 'year'
    ];

    protected $table = 'publications';

    protected $dates = ['deleted_at'];

    public function authors(){
        return $this->belongsToMany('App\Author');
    }

}
