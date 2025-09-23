<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\GenreController;
// use App\Http\Controllers\SongController;
// use App\Http\Controllers\PlaylistController;
// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\HomeController;



// // Route::get('/', function () {
// //     return view('home');
// // })->name('home');

// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | contains the "web" middleware group. Now create something great!
// |
// */


// Route::get('/',[HomeController::class, 'index'])->name('home');

// // Show all genres
// Route::get('/genres', [GenreController::class, 'index']);

// // Show songs for a selected genre
// Route::get('/genres/{genre}/songs', [SongController::class, 'index']);
// Route::get('/songs/{song}', [SongController::class, 'show']);

// // Show form to create a playlist
// Route::get('/playlists/create', [PlaylistController::class, 'create']);

// // Store a new playlist
// Route::post('/playlists', [PlaylistController::class, 'store']);

// // Show all playlists
// Route::get('/playlists', [PlaylistController::class, 'index']);

// // Show form to add songs to a playlist
// Route::get('/playlists/{playlist}/add-songs', [PlaylistController::class, 'addSongsForm']);

// // Attach songs to a playlist
// Route::post('/playlists/{playlist}/songs', [PlaylistController::class, 'attachSongs']);

// // Show songs in a playlist
// Route::get('/playlists/{playlist}/songs', [PlaylistController::class, 'showSongs']);

// // all songs
// Route::get('/songs', [SongController::class, 'all']);

// // ////SONGS
// // // Show edit form
// // Route::get('/songs/{song}/edit', [SongController::class, 'edit']);

// // // Handle update
// // Route::put('/songs/{song}', [SongController::class, 'update']);

// // // Handle delete
// // Route::delete('/songs/{song}', [SongController::class, 'destroy']);

// /// playlist
// // Show edit form
// Route::get('/playlists/{playlist}/edit', [PlaylistController::class, 'edit']);

// // Handle update
// Route::put('/playlists/{playlist}', [PlaylistController::class, 'update']);

// // Handle delete
// Route::delete('/playlists/{playlist}', [PlaylistController::class, 'destroy']);

// /// filters
// Route::get('/songs', [SongController::class, 'index']);

// // (genre to songs)
// Route::get('/genres/{genre}', [GenreController::class, 'show'])->name('genres.show');

// /// for Autantication

// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);

// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// // Protect playlist management
// Route::middleware(['auth'])->group(function () {
//     Route::get('/playlists/create', [PlaylistController::class, 'create']);
//     Route::post('/playlists', [PlaylistController::class, 'store']);
//     Route::get('/playlists/{playlist}/edit', [PlaylistController::class, 'edit']);
//     Route::put('/playlists/{playlist}', [PlaylistController::class, 'update']);
//     Route::delete('/playlists/{playlist}', [PlaylistController::class, 'destroy']);
    

//     ////SONGS
//     // Show edit form
//     Route::get('/songs/{song}/edit', [SongController::class, 'edit']);

//     // Handle update
//     Route::put('/songs/{song}', [SongController::class, 'update']);

//     // Handle delete
//     Route::delete('/songs/{song}', [SongController::class, 'destroy']);

// });

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Genres
Route::get('/genres', [GenreController::class, 'index']);
Route::get('/genres/{genre}', [GenreController::class, 'show'])->name('genres.show');
Route::get('/genres/{genre}/songs', [SongController::class, 'index']); // songs by genre

// Songs
Route::get('/songs', [SongController::class, 'index']); // with optional ?genre_id
Route::get('/songs/{song}', [SongController::class, 'show']);

// Playlists (public access to view songs)
Route::get('/playlists/create', [PlaylistController::class, 'create']);
Route::get('/playlists', [PlaylistController::class, 'index']);
Route::get('/playlists/{playlist}', [PlaylistController::class, 'show'])->name('playlists.show');
Route::get('/playlists/{playlist}/songs', [PlaylistController::class, 'showSongs']);
Route::get('/playlists/{playlist}/add-songs', [PlaylistController::class, 'addSongsForm']);
Route::post('/playlists/{playlist}/songs', [PlaylistController::class, 'attachSongs']);

// Protected routes (only for logged-in users)
Route::middleware(['auth'])->group(function () {
    Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlists.index');
    // Playlist management
    Route::delete('/playlists/{playlist}/songs/{song}', [PlaylistController::class, 'detachSong'])->name('playlists.detachSong');

    Route::get('/playlists/create', [PlaylistController::class, 'create']);
    Route::post('/playlists', [PlaylistController::class, 'store']);
    // Route::get('/playlists/{playlist}/edit', [PlaylistController::class, 'edit']);
    Route::get('/playlists/{playlist}/edit', [PlaylistController::class, 'edit'])->name('playlists.edit');
    Route::put('/playlists/{playlist}', [PlaylistController::class, 'update']);
    // Route::delete('/playlists/{playlist}', [PlaylistController::class, 'destroy']);
    Route::delete('/playlists/{playlist}', [PlaylistController::class, 'destroy'])->name('playlists.destroy');

    // Song management
    Route::get('/songs/{song}/edit', [SongController::class, 'edit']);
    Route::put('/songs/{song}', [SongController::class, 'update']);
    Route::delete('/songs/{song}', [SongController::class, 'destroy']);
    Route::get('/songs/create', [SongController::class, 'create'])->name('songs.create');
    Route::post('/songs', [SongController::class, 'store'])->name('songs.store');
});
