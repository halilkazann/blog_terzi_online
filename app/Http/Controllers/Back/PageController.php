<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
   public function index()
   {
       $pages = Page::all();
       return view('backend.pages.index',compact('pages'));
   }

    public function create(Request $request)
    {

            return view('backend.pages.create');


    }

    public function createpost(Request $request)
    {
        if($request->title)
        {
            $isExist = Page::whereSlug(Str::slug($request->slug))->first();
            if ($isExist)
            {
                flash()->preset('error',['value'=>'Sayfa eklemeye çalışırken','extra'=>'Kategori sistemde mevcut.']);
                return redirect()->route('admin.page.create');
             }

            $Page = new Page();
            $Page->title = $request->title;
            $Page->slug = STR::slug($request->slug);

            if ($request->hasFile('image')){
                $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/pages/'),$imageName);
                $Page->image = 'uploads/pages/'.$imageName;
            }

            $Page->content = $request->contentText;
            $Page->order = $request->orderPage;
            $Page->save();
            flash()->success('Sayfa ekleme İşlemi Başarılı');
            return redirect()->route('admin.page.create');
            }
        else
        {
            return view('backend.pages.create');
        }

    }

    public function getData(Request $request)
    {
        $id = $request->id;
        $category = Page::query()->findOrFail($id);
        return response()->json($category);
    }
   public function switch(Request $request)
   {
       $id = $request->id;
       $pages = Page::query()->findOrFail($id);
       $pages->status = $request->statu =="true" ? 1 : 0 ;
       $pages->save();
   }

}
