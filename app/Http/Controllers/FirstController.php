<?php

namespace App\Http\Controllers;

// Ajout class Song
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    return view("firstcontroller.index", ["songs" => $songs]);
  }

  public function about(){
    return view("firstcontroller.about");
  }

  public function article($id){
    return view("firstcontroller.article", ["id" => $id]);
  }

  public function user($id){

    $user = User::findorFail($id);

    return view('firstcontroller.user', ["user" => $user]);
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
    $request->file('song')->move("uploads/".Auth::id(), $name);
    $song->title = $request->input('title');
    $song->url = "/uploads/".Auth::id()."/".$name;
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

}
