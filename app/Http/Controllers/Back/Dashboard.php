<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class Dashboard extends Controller
{

    public function index()
    {
        return view('backend.dashboard');
    }
    public function profile()
    {
        $id = Auth::user()->id;
        $admin = Admin::query()->find($id);

        return view('backend.profile.index',compact('admin'));
    }
    public function profileUpdate(Request $request)
    {

        $name = $request->name;
        $pass = $request->pass;
        $newPass = $request->newPass;

        return "Name:" . $name . "<br>Pass :" . $pass . "<br>NewPass : " . $newPass ;


    }


    public function makale_ekle()
    {
        return ('Makale Ekle');
    }
}
