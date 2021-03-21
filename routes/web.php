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

Route::get('/', [FirstController::class, 'index']);
Route::get('/about', [FirstController::class, 'about']);
// Where = id = un chiffre entre 0 et 9 et au moins une fois
Route::get('/article/{id}', [FirstController::class, 'article'])->where('id','[0-9]+');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// MiddleWare : si tu n'arrives pas passer la porte connexion (condition d'accès)
Route::get('/songs/create', [FirstController::class, "create"])->middleware('auth')->name('songs.create');
Route::post('/songs', [FirstController::class, "store"])->middleware('auth');;

Route::get("/users/{id}", [FirstController::class, "user"])->where('id','[0-9]+');
Route::get('/changeLike/{id}', [FirstController::class, "changeLike"])->middleware('auth')->where('id','[0-9]+');
Auth::routes();

Route::get('/search/{search}', [FirstController::class, "search"]);
Route::get('/test', [FirstController::class, "test"]);

Route::get('/audio/{id}', [FirstController::class, "audio"])->where('id','[0-9]+')->middleware('auth');

Route::get("/render/{id}/{file}", [firstController::class, "render"]);
Route::post('/users/updatedescription', [FirstController::class, "updatedescription"]);

// Playlist
Route::get('/playlist/nouvelle', [FirstController::class, "nouvelleplaylist"])->middleware('auth');
Route::post('/playlist/create', [FirstController::class, "creerplaylist"])->middleware('auth');
Route::get('/infosplaylist/{id}', [FirstController::class, "infosplaylist"])->where ('id', '[0-9]+')->middleware('auth');
Route::get('/playlist/update/{idplaylist}/{idchanson}', [FirstController::class, "ajoutplaylist"])->where ('idchanson', '[0-9]+')->middleware('auth');
