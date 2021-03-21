<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function songs(){
      return $this->hasMany('App\Models\Song', "user_id"); // SELECT * FROM songs WHERE user_id = $this->id
    }

    public function playlist(){
        return $this->hasMany("App\Models\Playlist", "user_id");
        //SELECT * FROM playlist WHERE user_id=?
    }

    public function ILikeThem(){
      // Select * from users JOIN connection ON to_id =users.id WHERE from_id=$this->id
      return $this->belongsToMany("App\Models\User", "connection", "from_id", "to_id");
    }

    public function TheyLikeMe(){
      // Select * from users JOIN connection ON from_id =users.id WHERE to_id=$this->id
      return $this->belongsToMany("App\Models\User", "connection", "to_id", "from_id");
    }

    public function jeLike(){
        return $this->belongsToMany("App\Models\Song", "like", "user_id", "chanson_id");
    }

}
