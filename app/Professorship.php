<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professorship extends Model
{
    //
    protected $fillable = [
        'name', 'code'
    ];

    protected $table = 'Professorships';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
