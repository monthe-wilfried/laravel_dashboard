<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'professorship_id', 'title', 'content'
    ];

    protected $dates = ['deleted_at'];

    public function professorship(){
        return $this->belongsTo('App\Professorship');
    }

}
