<?php

namespace App\Http\Controllers;

// Ajout class Song
use App\Models\Song;
use App\Models\User;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

class FirstController extends Controller
{
  public function index(){

    $articles = [1 => "Article 1", 2 => "Le deuxième", 3 => "Numéro 3", 4 => "Article n°4"];

    // $songs = Song::all(); // SELECT * FROM songs
    // $songs = Song::find(1); // SELECT * FROM songs WHERE id = 1
    // $songs = Song::findorFail(1); // Si tu ne trouves pas alors go 404.php
    // $songs->votes++; // Ajoute 1 à l'élément vote dans la table songs
    // $songs->save(); // Save les données dans la BDD
    // dd($songs);

    // Ajouter une chanson

    // $songs = new Song(); // Créé une nouvelle chanson
    // $song->title = "Ma chanson préféré";
    // $song->url = "";
    // $song->votes = 0;
    // $song->save();

    $songs = Song::all();
    $playlists = Playlist::all();

    return view("firstcontroller.index", ["songs" => $songs, "playlists"=>$playlists]);
  }

  public function about(){
    return view("firstcontroller.about");
  }

  public function article($id){
    return view("firstcontroller.article", ["id" => $id]);
  }

  public function user($id){
    // dd($id);
    $playlists = Playlist::all();  //SELECT * FROM playlist
    $user = User::findorFail($id);

    return view('firstcontroller.user', ["user" => $user, "playlists"=>$playlists]);
  }

  public function search($search){

    // Select * from users WHERE name LIKE '$search%';
    $users = User::whereRaw("name LIKE CONCAT(?, '%')", [$search])->orderBy('id', 'desc')->get();

    $songs = Song::whereRaw("title LIKE CONCAT('%', ?, '%')", [$search])->orderBy('votes', 'desc')->get();

    return view('firstcontroller.search', ["search" => $search, "users" => $users, "songs" => $songs]);
  }


  public function create(){
    return view('firstcontroller.create');
  }

  public function store(Request $request){
    // return $request->input('title'); // Récupérer le titre de la chanson qui vient d'être post
    // phpinfo();
    // dd($_FILES, $request->file('song'));

    $request->validate([ // Faire une validation du fichier uploadé, si bon upload, sinon retour vers le formulaire
      'title' => 'required|min:4|max:255',
      'song' => 'required|file|mimes:mp3,ogg,mp4a,m4a,mpga,webm',
      "image" => 'required|file'
    ]);

    $song = new Song();
    $name = $request->file('song')->hashName(); // On hash pour que si 2 musiques ont le même nom, ça ne supprime pas l'ancien fichier
    // $request->file('song')->move("uploads/".Auth::id(), $name);
    $path = $request->file('song')->store('song/'.Auth::id());
    $song->title = $request->input('title');
    // $song->url = "/uploads/".Auth::id()."/".$name;
    $song->url = $path;
    $song->votes = 0;
    $song->user_id = Auth::id();

    $name_img = $request->file('image')->hashName();
    $request->file('image')->move("uploads/".Auth::id(), $name_img);
    $song->image = "/uploads/".Auth::id()."/".$name_img;


    $song->save();

    return redirect("/")->with('toastr', ["status"=>"success", "message" => "Chanson chargée avec succès"]);
  }

  public function changeLike($id){
    Auth::user()->ILikeThem()->toggle($id);
    return back()->with('toastr', ["status"=>"success", "message"=> "Modification suivi"]);
  }

  public function like($id){
    Auth::user()->jeLike()->toggle($id);
    return redirect('/');
  }

    public function liked($id){
        return Auth::user()->jeLike->contains($id) ? 1 : 0;
    }

  public function elleEstLikee(){
    return $this->belongsToMany("App\Models\Song", "like", "chanson_id", "user_id");
  }

  public function updatedescription(Request $request){
    $description = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $request->input('description'));
    Auth::user()->description = $description;
    Auth::user()->save();
    return back()->with('toastr', ["status"=>"success", "message"=> "Votre description a bien été modifiée !"]);
  }

  public function audio($id){
    $song = Song::find($id);
    return view('firstcontroller.audio', ['song' => $song]);
  }

  public function render($id, $file) {
    $song = Song::find($id);
    $file = storage_path("app/".$song->url);
    $test = File::get($file);
      $mime_type = "audio/mp3";

      $fileContents = File::get($file);
      return Response::make($fileContents, 200)
                  ->header('Accept-Ranges', 'bytes')
                  ->header('Content-Type', $mime_type)
                  ->header('Content-Length', filesize($file))
                  ->header('vary', 'Accept-Encoding');
  }

  // Playlist
  public function nouvelleplaylist(){
    $playlists= Playlist::all();  // SELECT * FROM playlist
    $user= User::findOrFail(Auth::id());
    return view("firstcontroller.addPlaylist", ["active" => "playlist","playlists"=>$playlists,"utilisateur"=>$user]);
  }

  public function infosplaylist($id){
    $chansons= Song::all();
    $playlist= Playlist::findOrFail($id);  //SELECT * FROM playlist
    $playlists= Playlist::all();
    $user = User::findOrFail(Auth::id());
    return view("firstcontroller.infosplaylist", ["playlist"=>$playlist,"chansons"=>$chansons,"active" => "playlist","utilisateur"=>$user,"playlists"=>$playlists]);
  }

  public function creerplaylist(Request $request){
      $request->validate([
          'nom' => 'required|min:3|max:255',
          'imgMusiq' => 'required|file',
      ]);

      $name= $request->file('imgMusiq')->hashName();
      $request->file('imgMusiq')->move("uploads/".Auth::id(), $name);
      $idchanson= $request->input('idchanson');


      $c = new Playlist();
      $c->nom = $request->input('nom');
      $c->url_image = "/uploads/".Auth::id()."/".$name;
      $c->user_id = Auth::id();
      $c->save();

      if($idchanson >  0){
          $idplaylist = Playlist::all()->last()->id;
          $this->ajoutplaylist($idplaylist,$idchanson);
          return redirect('/infosplaylist/'.$idplaylist)->with('toastr', ["status"=>"success", "message"=> "Votre playlist a bien été créé"]);
      }else{
          return redirect("/")->with('toastr', ["status"=>"success", "message"=> "Votre playlist a bien été créé"]);
      }
  }

  public function ajoutplaylist($idplaylist,$idchanson){
    Playlist::findOrFail($idplaylist)->aLaChanson()->toggle($idchanson);
    $songs = Song::all();
    $playlists = Playlist::all();

    return view("firstcontroller.index", ["songs" => $songs, "playlists"=>$playlists])->with('toastr', ["status"=>"success", "message"=> "Votre musique a bien été retirée !"]);
  }

}
