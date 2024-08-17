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

    public function getData(Request $request)
    {
        $id = $request->id;
        $category = Category::query()->findOrFail($id);
        return response()->json($category);
    }

    public function delete(Request $request)
    {
        $category = Category::query()->find($request->id);

        if (is_null($category)){
            flash()->error('Böyle bir kategori sistemde bulunmaktadır.');
        }else{
            $deleted = $category->delete();
            if ($deleted){
                flash()->success('Kategori başarıyla silindi.');
            }else{
                flash()->error('Kategori silinirken hata oluştu.');
            }
        }

        return redirect()->back();

    }

    public function update(Request $request)
    {
        $isSlug = Category::whereSlug(Str::slug($request->slug))->whereNotIn('id',[$request->id])->first();
        $isName = Category::whereName($request->category)->whereNotIn('id',[$request->id])->first();
        if ($isSlug or $isName ){
            flash()->error($request->category . 'Aynı isimde/linkte kategori sistemde bulunmaktadır.');
            return redirect()->route('admin.category.index');
        }

        $category = Category::query()->find($request->id);
        $category->name = $request->category;
        $category->slug = STR::slug($request->slug);
        $category->save();
        flash()->success('Kategori güncelleme İşlemi Başarılı');
        return redirect()->back();
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
