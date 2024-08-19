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
        $id = Auth::user()->id;

        $name = $request->admin_name;
        $email = $request->admin_email;
        $newPass = $request->admin_newPass;
        $admin = Admin::query()->find($id);

        if(isset($newPass)){

            $admin->name = $name;
            $admin->email = $email ;
            $admin->password = bcrypt($newPass);
            $admin->save();
            flash()->preset('updated');
            return redirect()->back();
        }
        flash()->preset('error');
        return redirect()->back();







    }


    public function makale_ekle()
    {
        return ('Makale Ekle');
    }
}
