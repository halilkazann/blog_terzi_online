<?php

namespace App\Http\Controllers\Front;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator as Validator;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Page;


class Homepage extends Controller
{
    public function category($slug)
    {

        $category = Category::query()->where('slug',$slug)->first();
        $article = Article::query()->where('category_id',$category->id)->paginate(4);
        $data['pages'] = Page::query()->orderBy('order','ASC')->get();
        $data['articles'] = $article;
        $data['category'] = $category;
        $data['categories'] = Category::all();

        return view('front.category',$data);
    }
    public function index()
    {
        $data['articles'] = Article::query()->paginate(3);

        $data['categories'] = Category::all();

        $data['pages'] = Page::query()->orderBy('order','ASC')->get();

        return view('front.homepage',$data);
    }


    public function single($category,$slug)
    {

        $kategori = Category::whereSlug($category)->first() ?? abort(404);
        $article = Article::query()->where('slug',$slug)->where('category_id',$kategori->id)->first() ?? abort(404 );
        $data['pages'] = Page::query()->orderBy('order','ASC')->get();

        $article->increment('hit');
        $data['categories'] = Category::all();
        $data['articles'] =$article;
        return view('front.single',$data);
    }

    public function page($slug)
    {
        $page = Page::whereSlug($slug)->first() ?? abort(403, 'Böyle bir sayfa bulunamadı');
        $data['pages'] = Page::query()->orderBy('order','ASC')->get();
        $data['page'] = $page;

        return view('front.page',$data);

    }

    public function contact()
    {
        $data['articles'] = Article::query()->paginate(2);

        $data['categories'] = Category::all();

        $data['pages'] = Page::query()->orderBy('order','ASC')->get();

       return view('front.contact',$data);

    }

    public function contactpost(Request $request) : RedirectResponse
    {

      $rules = [
          'name'=>'required|min:5',
          'email'=>'required|email',
          'phone'=>'required|min:10|max:11',
          'message'=>'required|min:10'
      ];

      $validate = Validator::make($request->all(),$rules);

        if ($validate->fails()) {
            return redirect()->route('contact')->withErrors($validate)->withInput();

        }

        $contact = new Contact();

        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->phone=$request->phone;
        $contact->content=$request->message;
        $contact->save();
        return redirect()->route('contact')->with('success','Mesajınız tarafımıza ulaşmıştır.');



    }

}
