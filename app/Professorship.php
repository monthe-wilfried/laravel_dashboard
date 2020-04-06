<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professorship extends Model
{
    //
    protected $fillable = [
        'name', 'code'
    ];

    public function user(){
        $this->belongsTo('App\User');
    }
}
