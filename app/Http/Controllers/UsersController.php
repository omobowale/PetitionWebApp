<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Petition;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:view']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!empty($user) || $user != null) {
            return view('users.index')->with('user', $user);
        }

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        //delete all of their petitions first
        $petitions = $user->petitions()->get();
        $signatures = $user->signatures()->get();

        foreach ($petitions as $petition) {
            $petition->delete();
        }

        foreach ($signatures as $signature) {
            $signature->delete();
        }

        //delete the user
        $user->delete();

        $users = User::paginate(10);
        $petitions = Petition::paginate(10);

        return view('admin.index')->with([
            'message' => 'User deleted',
            'petitions' => $petitions,
            'users' => $users,
        ]);
    }
}
