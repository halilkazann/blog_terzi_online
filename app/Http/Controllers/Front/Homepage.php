<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Category;

class Homepage extends Controller
{
    public function index()
    {
        $data['articles'] = Article::all();
        $data['categories'] = Category::all();

        return view('front.homepage',$data);
    }

    public function single($slug)
    {
        return view('front.single');
    }

}
