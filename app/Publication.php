<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publication extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'title', 'author', 'year'
    ];

    protected $table = 'publications';

    protected $dates = ['deleted_at'];

    public function users(){
        return $this->belongsToMany('App\User');
    }

}
