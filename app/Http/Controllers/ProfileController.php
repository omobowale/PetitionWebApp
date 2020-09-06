<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Session;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $authuserid = Auth::user()->id;
        $user = User::find($authuserid);
        $user->name = $request->input('name');
        $user->save();

        return back()->with('message', 'Your name has been updated');
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $authuserid = Auth::user()->id;
        $user = User::find($authuserid);
        $user->email = $request->input('email');
        $user->save();

        return back()->with('message', 'Your email has been updated');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
            //'npassword' =>
        ]);

        $password = Auth::user()->password;
        $enteredpassword = Hash::make($request->input('password'));
        if (Hash::check($request->input('password'), $password)) {
            $request->validate([
                'npassword' => 'required|string',
                'cpassword' => 'required|string',
            ]);

            if ($request->input('npassword') === $request->input('cpassword')) {
                $request
                    ->user()
                    ->fill([
                        'password' => Hash::make($request->input('npassword')),
                    ])
                    ->save();
                return back()->with(
                    'message',
                    'Successfully updated your password'
                );
            }
        } else {
            Session::flash('error', 'Unable to reset password');
            return back();
        }
    }

    public function updatePasswordByAdmin(Request $request)
    {
        $request->validate([
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        $request
            ->user()
            ->fill([
                'password' => Hash::make($request->input('npassword')),
            ])
            ->save();
        return back()->with('message', 'Successfully updated your password');
    }
}
