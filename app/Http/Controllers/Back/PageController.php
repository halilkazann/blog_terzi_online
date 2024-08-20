<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
   public function index()
   {
       $pages = Page::all();
       return view('backend.pages.index',compact('pages'));
   }

   public function switch(Request $request)
   {
       $id = $request->id;
       $pages = Page::query()->findOrFail($id);
       $pages->status = $request->statu =="true" ? 1 : 0 ;
       $pages->save();
   }

   public function create()
   {
       return view('backend.pages.index');
   }
}
