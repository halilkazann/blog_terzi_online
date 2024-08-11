<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('backend.auth.login');
    }

    public function loginPost(Request $request)
    {
        $email = $request->email;
        $password = $request->password;


        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->route('admin.panel');
        }
        return redirect()->route('admin.login')->withErrors('Email adresi veya şifre hatalı!');

    }

    public function logout()
    {

        Auth::logout();
        toastr()->success("Hoşgeldin" . Auth::user()->name);
        return redirect()->route('admin.login');
    }

}
