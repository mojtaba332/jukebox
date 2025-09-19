<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\Auth;
 
class HomeController extends Controller
{
    /**
     * Show welcome page for everyone (always)
     */
    public function index()
    {
        return view('home');
    }
 
    /**
     * Show dashboard (only for logged in users)
     */
    // public function dashboard()
    // {
    //     $playlists = Auth::user()->playlists()->withCount('songs')->get();
    //     return view('dashboard', compact('playlists'));
    // }
}
 