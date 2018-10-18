<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function profile()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    public function getProfilePic($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

    public function saveProfilePic(Request $request)
    {
        $file = $request->file('profilepic');
        $filename = Auth::user()->username. '.jpg';

        if ($file) {
            Storage::disk('local')->put($filename, File::get($file));
            return redirect('profile');
        }

    }

    public function editProfile(Request $request)
    {
        $user = Auth::user();
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->update();

        return redirect('profile');
    }

    public function postSignup(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:users', // ** users is the table name
            'password' => 'required|min:6',
            'username' => 'required|unique:users',
        ]);

        $email = $request['email'];
        $password = bcrypt($request['password']);
        $username = $request['username'];

        $user = new User();
        $user->email = $email;
        $user->password = $password;
        $user->username = $username;

        $user->save();
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function postLogin(Request $request)
    {

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back();
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/first');
    }
}
