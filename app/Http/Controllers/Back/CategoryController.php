<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('backend.categories.index', compact('categories'));
    }

    public function switch(Request $request)
    {
        $id = $request->id;
        $category = Category::query()->findOrFail($id);
        $category->status = $request->statu == "true" ? 1 : 0;
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
        if($request->id == 1){
            flash()->error('_system Kategorisini silemezsin.');
            return redirect()->back();
        }else {

            $category = Category::query()->find($request->id);

            $article = Article::query()->where('category_id', '=', $request->id)->get();
            if (count($article) > 0) {
                flash()->preset('error', ['value' => $category->name . " kategorisini silerken", 'extra' => 'Öncelikle kategoriye ait makaleleri silmeniz gerekmektedir. ']);
                return redirect()->back();
            } else {
                $category = Category::query()->find($request->id);

                if (is_null($category)) {
                    flash()->preset('not_found');
                } else {
                    $deleted = $category->delete();
                    if ($deleted) {
                        flash()->preset('deleted', ['value' => 'Kategori']);
                    } else {
                        flash()->preset('error', ['value' => 'Kategori silinirken']);
                    }
                }

                return redirect()->back();
            }

        }
    }

    public function forcedelete(Request $request)
    {
        if($request->id == 1){
            flash()->error('_system Kategorisini silemezsin.');
            return redirect()->back();
        }else{


        $action = $request->input('action');
        $category = Category::find($request->id);

        if (is_null($category)) {
            flash()->error('Böyle bir kategori sistemde bulunmamaktadır.');
            return redirect()->back();
        }

        if ($action == 'fulldata') {
            // Kategoriye bağlı makaleleri sil
            $articles = Article::where('category_id', $category->id)->get();

            foreach ($articles as $article) {
                $article->delete();
            }

            // Kategoriyi sil
            $category->delete();

            flash()->success('Kategori ve bağlı makaleler başarıyla silindi.');
        } elseif ($action == 'onlycat') {
            // Kategoriye bağlı makalelerin kategori_id alanını null yaparak kategoriyi sil
            Article::where('category_id', $category->id)->update(['category_id' => 1]);

            $category->delete();

            flash()->success('Kategori başarıyla silindi, makaleler güncellendi.');
        }

        return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        if($request->id == 1){
            flash()->error('_system kategorisini güncelleyemezsin!');
            return redirect()->back();
        }else{
            $isSlug = Category::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
            $isName = Category::whereName($request->category)->whereNotIn('id', [$request->id])->first();
            if ($isSlug or $isName) {
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

    }

    public function create(Request $request)
    {
        $isExist = Category::whereSlug(Str::slug($request->category))->first();
        if ($isExist) {
            flash()->error('Aynı isimde kategori sistemde bulunmaktadır.');
            return redirect()->route('admin.category.index');
        }

        $category = new Category();
        $category->name = $request->category;
        $category->slug = STR::slug($request->category);
        $category->save();
        flash()->success('Kategori ekleme İşlemi Başarılı');
        return redirect()->route('admin.category.index');
    }
}
