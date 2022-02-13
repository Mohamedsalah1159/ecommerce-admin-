<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Requests\MainCategoryRequest;
use Illuminate\Support\Facades\config;
use DB;
use Illuminate\Support\Str;



class MainCategoryController extends Controller
{
    public function index(){
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang) ->selection() ->get();
        return view('admin.maincategories.index', compact('categories'));
    }
    public function create(){
        return view('admin.maincategories.create');
    }
    public function store(MainCategoryRequest $request){
        try{ 
            //return request
            $main_categoiry = collect($request -> category); //to make collection
            $filter = $main_categoiry -> filter(function($value, $key){  // value: one of collection
                return $value['abbr'] == get_default_lang();
            });
            $default_category = array_values($filter -> all()) [0];
            $filePath = "";
            if($request-> has('photo')){
                $filePath = uploadimage('maincategories', $request->photo);
            }
            DB::beginTransaction();
            $default_category_id = MainCategory::insertGetId([
                'translation_lang' => $default_category ['abbr'],
                'translation_of' => 0,
                'name' => $default_category ['name'],
                'slug' => $default_category ['name'],
                'photo' => $filePath,


            ]);

            $categories = $main_categoiry -> filter(function($value, $key){  // value: one of collection
                return $value['abbr'] != get_default_lang();
            });
            if(isset($categories) && $categories->count()){
                $categories_arr = [];
                foreach ($categories as $category){
                    $categories_arr[] = [
                        'translation_lang' => $category ['abbr'],
                        'translation_of' => $default_category_id ,
                        'name' => $category ['name'],
                        'slug' => $category ['name'],
                        'photo' => $filePath,
                    ] ;
                }
                MainCategory::insert($categories_arr);
            }
            DB::commit();
            return redirect()->route('admin.maincategories')->with(['success' => 'تم الحفظ بنجاح']);
        }catch(\Exception $ex){
            DB::rollback();
            return redirect()->route('admin.maincategories')->with(['error' => 'هناك خطأ ما']);

        }
    }
    public function edit($mainCat_id){
        //get spacific categories and its translations
        $mainCategory = MainCategory::with("categories")->selection()->find($mainCat_id);
        if(! $mainCategory){
            return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود']);
        }
        return view('admin.maincategories.edit', compact('mainCategory'));
    }
    public function update($mainCat_id, MainCategoryRequest $request)
    {
        try {
            $main_category = MainCategory::find($mainCat_id);

            if (!$main_category){
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);
            }
            
            // update date

            $category = array_values($request->category) [0];

            if (!$request->has('category.0.active')){
                $request->request->add(['active' => 0]);
            }else{
                $request->request->add(['active' => 1]);
            }
            MainCategory::where('id', $mainCat_id)
                ->update([
                    'category[0][name]' => $category['name'],
                    'category[0][active]' => $request->active,
                ]);

            // save image

            if ($request->has('photo')) {
                $filePath = uploadImage('maincategories', $request->photo);
                MainCategory::where('id', $mainCat_id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }


            return redirect()->route('admin.maincategories')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }
    public function destroy($id){
        try{
            $maincategory= MainCategory::find($id);
            if(! $maincategory){
                return redirect()->route('admin.maincategories')->with('error', 'عفوا لا يوجد هذا القسم');
            }
            $vendors = $maincategory->vendors();
            if(isset($vendors) && $vendors->count() > 0){
                return redirect()->route('admin.maincategories')->with('error', 'لا يمكن حذف هذا القسم');
            }

            $image = Str::afterLast($maincategory->photo, 'assets/');
            $image = base_path('assets/' . $image);
            unlink($image); //delete photo from folder
            
            //delete translation
            $maincategory->categories()->delete();
            $maincategory->delete();
            return redirect()->route('admin.maincategories')->with('success', 'تم حذف القسم بنجاح');


        }catch(\Exception $ex){
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
    }
    public function changestatus($id){
        try{
            $category= MainCategory::find($id);
            if(!$category){
                return redirect()->route('admin.maincategories')->with('error', 'عفوا لا يوجد هذا القسم');
            }
            $status = $category->active == 0 ? 1 : 0;
            $category->update(['active' => $status]);
            return redirect()->route('admin.maincategories')->with('success', 'تم تغيير الحاله بنجاح');

        }catch(\Exception $ex){
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
