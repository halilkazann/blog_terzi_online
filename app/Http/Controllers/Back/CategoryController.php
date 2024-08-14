<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('backend.categories.index',compact('categories'));
    }

    public function switch(Request $request)
    {
        $id = $request->id;
        $category = Category::query()->findOrFail($id);
        $category->status = $request->statu =="true" ? 1 : 0 ;
        $category->save();
    }

    public function create(Request $request)
    {
        $isExist = Category::whereSlug(Str::slug($request->category))->first();
       if ($isExist){
           toastr()->error('Aynı isimde kategori sistemde bulunmaktadır.');
           return redirect()->route('admin.category.index');
       }

        $category = new Category();
        $category->name = $request->category;
        $category->slug = STR::slug($request->category);
        $category->save();
        toastr()->success('Kategori ekleme İşlemi Başarılı');
        return redirect()->route('admin.category.index');
    }
}
