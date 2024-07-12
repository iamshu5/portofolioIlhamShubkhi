<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthLoginController extends Controller
{
    //
    public function checkLogin() {
        if( Auth::check()) {
            return redirect('/home');
        }
        return view('login');
    }

    public function process(Request $request) {
        $user = User::where('username', $request->username)->first();

        if($user == NULL) {
            return redirect('Auth/Login')->with('alert', ['bg' => 'danger', 'message' => 'Username tidak terdaftar!']);
        }

        if(!Hash::check($request->passwordHash, $user->passwordHash)) {
            return redirect('Auth/Login')->with('alert', ['bg' => 'danger', 'message' => 'password tidak valid!']);
        }

        Auth::login($user);
        return redirect('/home');
    }

    public function usrLogout() {
        Auth::logout();
        return redirect('/Auth/Login')->with('alert', ['bg' => 'success', 'message' => 'Berhasil Logout!']);
    }
}
