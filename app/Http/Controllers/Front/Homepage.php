<?php

namespace App\Http\Controllers\Front;
use Illuminate\Pagination\Paginator;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Category;

class Homepage extends Controller
{
    public function category($slug)
    {

        $category = Category::query()->where('slug',$slug)->first();
        $article = Article::query()->where('category_id',$category->id)->paginate(4);

        $data['articles'] = $article;
        $data['category'] = $category;
        $data['categories'] = Category::all();

        return view('front.category',$data);
    }
    public function index()
    {
        $data['articles'] = Article::query()->paginate(2);

        $data['categories'] = Category::all();

        return view('front.homepage',$data);
    }


    public function single($category,$slug)
    {

        $kategori = Category::whereSlug($category)->first() ?? abort(404);
        $article = Article::query()->where('slug',$slug)->where('category_id',$kategori->id)->first() ?? abort(404 );

        $article->increment('hit');
        $data['categories'] = Category::all();
        $data['articles'] =$article;
        return view('front.single',$data);
    }

}
