<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Petition;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Get logged in user
        $user_id = Auth::user()->id;
        $petitions = User::find($user_id)
            ->petitions()
            ->get();

        return view('home')->with('petitions', $petitions);
    }
}
