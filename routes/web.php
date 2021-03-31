<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get("/", "FirstController@index");

// Rediction auto vers la langue par défaut
Route::redirect('/', '/fr/');

Route::group(['prefix' => '{language}'], function (){

  Route::get('/', [FirstController::class, 'index'])->name('index');
  Route::get('/about', [FirstController::class, 'about']);
  // Where = id = un chiffre entre 0 et 9 et au moins une fois
  Route::get('/article/{id}', [FirstController::class, 'article'])->where('id','[0-9]+');

  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

  // MiddleWare : si tu n'arrives pas passer la porte connexion (condition d'accès)
  Route::get('/songs/create', [FirstController::class, "create"])->middleware('auth')->name('songs.create');

  Route::get("/users/{id}", [FirstController::class, "user"])->where('id','[0-9]+')->name('users');
  Route::get('/changeLike/{id}', [FirstController::class, "changeLike"])->middleware('auth')->where('id','[0-9]+')->name('changeLike');

  Auth::routes();

  Route::get('/search/{search}', [FirstController::class, "search"])->name('search');
  Route::get('/test', [FirstController::class, "test"]);

  Route::get('/audio/{id}', [FirstController::class, "audio"])->where('id','[0-9]+')->middleware('auth');


  // Playlist
  Route::get('/playlist/nouvelle', [FirstController::class, "nouvelleplaylist"])->middleware('auth')->name('newplaylist');
  Route::post('/playlist/create', [FirstController::class, "creerplaylist"])->middleware('auth')->name('playlistcreate');
  Route::get('/infosplaylist/{id}', [FirstController::class, "infosplaylist"])->where ('id', '[0-9]+')->middleware('auth')->name('infosplaylist');


});

  // Route de recherche interne (pas besoin de traduction)
  Route::get("/render/{id}/{file}", [firstController::class, "render"]);
  Route::post('/songs', [FirstController::class, "store"])->middleware('auth');;
  Route::post('/users/updatedescription', [FirstController::class, "updatedescription"]);
  Route::get('/like/{id}', [FirstController::class, "like"])->where ('id', '[0-9]+')->middleware('auth');
  Route::get('/liked/{id}', [FirstController::class, "liked"])->where ('id', '[0-9]+')->middleware('auth');
  Route::get('/update/{idplaylist}/{idchanson}', [FirstController::class, "ajoutplaylist"])->where ('idchanson', '[0-9]+')->middleware('auth')->name('playlistupdate');
  Route::get('/playlist/supprimer/{idplaylist}', [FirstController::class, "supprimerplaylist"])->where ('idplaylist', '[0-9]+')->middleware('auth');
