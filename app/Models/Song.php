<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    // Mon modèle est adapté pour la table songs
    protected $table = 'songs';

    public function user(){
      return $this->belongsTo("App\Models\User", "user_id"); // Equivalent d'un SELECT * FROM users WHERE users.id = $this->user_id
    }

    public function playlist(){
        return $this->belongsTo("App\Models\Playlist", "playlist_id");
        // SELECT * FROM playlist WHERE playlists_id=?
    }

    public function elleEstLikee(){
        return $this->belongsToMany("App\Models\Song", "like");
    }

}
