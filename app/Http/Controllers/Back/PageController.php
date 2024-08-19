<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
   public function index()
   {

       return view('backend.pages.index');
   }

   public function create()
   {
       return view('backend.pages.index');
   }
}
