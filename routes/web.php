<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\SongController;



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
