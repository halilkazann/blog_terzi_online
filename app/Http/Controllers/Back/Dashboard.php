<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;

class Dashboard extends Controller
{

    public function index()
    {
        return view('backend.dashboard');
    }

    public function makale_ekle()
    {
        return ('Makale Ekle');
    }
}
