<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;
    // Mon modèle est adapté pour la table playlist
    protected $table = 'playlist';

    public function utilisateur(){
        return $this->belongsTo("App\Models\User", "user_id");
        // SELECT * FROM users WHERE user_id=?
        //et le ? est remplacè par le $this->id
    }
    public function chanson(){
        return $this->belongsTo("App\Models\Song", "chanson_id");
        // SELECT * FROM chansons WHERE chanson_id=?
        //et le ? est remplacè par le $this->id
    }
    public function aLaChanson(){
        return $this->belongsToMany("App\Models\Song", "contenuplaylist", "playlist_id", "chanson_id");
    }
}
