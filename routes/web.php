<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\PlaylistController;




Route::get('/', function () {
    return view('welcome');
});

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


// Show all genres
Route::get('/genres', [GenreController::class, 'index']);

// Show songs for a selected genre
Route::get('/genres/{genre}/songs', [SongController::class, 'index']);
Route::get('/songs/{song}', [SongController::class, 'show']);

// Show form to create a playlist
Route::get('/playlists/create', [PlaylistController::class, 'create']);

// Store a new playlist
Route::post('/playlists', [PlaylistController::class, 'store']);

// Show all playlists
Route::get('/playlists', [PlaylistController::class, 'index']);

// Show form to add songs to a playlist
Route::get('/playlists/{playlist}/add-songs', [PlaylistController::class, 'addSongsForm']);

// Attach songs to a playlist
Route::post('/playlists/{playlist}/songs', [PlaylistController::class, 'attachSongs']);

// Show songs in a playlist
Route::get('/playlists/{playlist}/songs', [PlaylistController::class, 'showSongs']);
