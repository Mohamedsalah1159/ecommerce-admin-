<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LangRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function index(){
        $languages = Language::select()->paginate(10);
        return view('admin.languages.index', compact('languages'));
    }
        public function create(){
        return view('admin.languages.create');
    }
    public function store(LangRequest $request){
            try {
                Language::create($request->except(['_token']));
                return redirect()->route('admin.languages')->with(['success' => 'تم حفظ اللغة بنجاح']);
            } catch (\Exception $ex) {
                return redirect()->route('admin.languages')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
            }
    }
    public function edit($id){
        $language = Language::select()->find($id);
        if(!$language){
            return redirect() ->route('admin.languages') ->with(['error' => 'هذه اللغه غير موجوده']);
        }
        return view('admin.languages.edit', compact('language'));
    }
    public function update($id,LangRequest $request){

        try {
            $language = Language::find($id);
            if(!$language){
                return redirect() ->route('admin.languages.edit', $id) ->with(['error' => 'هذه اللغه غير موجوده']);
            }
            if(!$request ->has('active')){
                $request -> request ->add(['active' => 0]);
            }
            $language -> update($request->except(['_token']));
            return redirect()->route('admin.languages')->with(['success' => 'تم تحديث اللغة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
    public function destroy($id){
            try {
                $language = Language::find($id);
                if(!$language){
                    return redirect() ->route('admin.languages', $id) ->with(['error' => 'هذه اللغه غير موجوده']);
                }
                $language -> delete();
                return redirect()->route('admin.languages')->with(['success' => 'تم حذف اللغة بنجاح']);
            } catch (\Exception $ex) {
                return redirect()->route('admin.languages')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
            }
    }
}