<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::query()->orderBy('created_at','ASC')->get();
        return view('backend.articles.index',compact('articles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorys = Category::query()->get();
        return view('backend.articles.create',compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->contentText;
        $article->slug = Str::slug($request->title);

        if ($request->hasFile('image')){
            $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $article->image = 'uploads/'.$imageName;
        }

        $article->save();
        toastr()->success('Ekleme İşlemi Başarılı');
        return redirect()->route('makaleler.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $article = Article::query()->findOrFail($id);


       $categorys = Category::query()->get();
       return view('backend.articles.update',compact('article','categorys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:jpeg,jpg,png|max:2048'
        ]);


        $article = Article::query()->findOrFail($id);
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->contentText;
        $article->slug = Str::slug($request->title);

        if ($request->hasFile('image')){
            $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $article->image = 'uploads/'.$imageName;
        }

        $article->save();
        toastr()->success('Güncelleme İşlemi Başarılı');
        return redirect()->route('makaleler.index');

    }

    public function switch(Request $request)
    {
        $id = $request->id;

        $article = Article::query()->findOrFail($id);
        $article->status = $request->statu =="true" ? 1 : 0 ;
        $article->save();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::query()->where('id',$id)->delete();
        $article->save();
        toastr()->primary('Makale Silme İşlemi Başarılı');
        return redirect()->route('makaleler.index');

    }
}
