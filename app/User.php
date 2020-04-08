<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'photo_id',
        'professorship_id',
        'biography',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';

    public function publications(){
        return $this->belongsToMany('App\Publication');
    }

    public function professorship(){
        return $this->belongsTo('App\Professorship');
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    // Accessor - Uppercase the first letter of each user's name
    public function getNameAttribute($name){
        $i = 0;
        $values = explode(' ', $name);
        foreach ($values as $value){
            $new_name[$i] = ucfirst($value);
            $i = $i + 1;
        }
        $new_name = implode(' ', $new_name);
        return $new_name;
    }

    // Checks if user is an admin
    public function isAdmin()
    {
        if ($this->role->name = 'administrator' && $this->is_active = 1){
            return true;
        }
        return false;
    }


}
