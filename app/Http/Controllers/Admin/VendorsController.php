<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\vendor;
use App\Models\MainCategory;
use App\Http\Requests\VendorRequest;
use App\Notifications\VendorCreated;

use Illuminate\Support\Facades\Notification;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;


class VendorsController extends Controller
{
    public function index(){
        $vendors = Vendor::selection()->paginate(PAGINATION_COUNT);
        return view('admin.vendors.index', compact('vendors'));

    }
    public function create(){
        $categories = MainCategory::where('translation_of', 0)->active()->get();
        return view('admin.vendors.create', compact("categories"));
    }
    public function store(VendorRequest $request){
        try{
            if (!$request->has('active')){
                $request->request->add(['active' => 0]);
            }else{
                $request->request->add(['active' => 1]);
            }

            $filePath ='';
            if ($request->has('logo')) {
                $filePath = uploadImage('vendors', $request->logo);
            }
            $vendor = Vendor::create([
                'name' => $request -> name,
                'mobile' => $request -> mobile,
                'email' => $request -> email,
                'active' => $request -> active,
                'password' => $request->password,
                'address' => $request -> address,
                'logo' => $filePath,
                'category_id' => $request -> category_id
            ]);
            /*Notification::send($vendor, new VendorCreated($vendor));*/
            return redirect()->route('admin.vendors')->with("success", "تم الحفظ بنجاح");
        }catch(\Exception $ex){
            return redirect()->route('admin.vendors')->with("error", "هناك خطأ ما");

        }

    }
    public function edit($id){
        try{
            $vendor = Vendor::selection()->find($id);
            if(!$vendor){
                return redirect()->route('admin.vendors')->with("error", "هذا المتجر غير موجود");
            }
            $categories = MainCategory::where('translation_of', 0)->active()->get();

            return view('admin.vendors.edit', compact('vendor', 'categories'));
        }catch(\Exception $ex){
            return redirect()->route('admin.vendors')->with("error", "هناك خطأ ما");
        }
    }
    public function update($id, VendorRequest $request){
        try{
            $vendor = Vendor::selection()->find($id);
            if(!$vendor){
                return redirect()->route('admin.vendors')->with("error", "هذا المتجر غير موجود");
            }
            DB::beginTransaction();

            //photo
            if ($request->has('logo') ) {
                $filePath = uploadImage('vendors', $request->logo);
                Vendor::where('id', $id)
                    ->update([
                        'logo' => $filePath,
                    ]);
            };
            $data= $request->except("_token", "id", "password", "logo");
            if ($request->has('password') ) {
                $data['password'] = $request->password;
            };
            Vendor::where('id', $id)->update($data);
            DB::commit();
            return redirect()->route('admin.vendors')->with("success", "تم التحديث بنجاح");
        }catch(\Exception $ex){
            return $ex;
            DB::rollback();
            return redirect()->route('admin.vendors')->with("error", "هناك خطأ ما");
        }

    }
    public function destroy($id){
        try{
            $vendor= Vendor::find($id);
            if(! $vendor){
                return redirect()->route('admin.vendors')->with('error', 'عفوا لا يوجد هذا المتجر');
            }

            $image = Str::afterLast($vendor->logo, 'assets/');
            $image = base_path('assets/' . $image);
            unlink($image); //delete photo from folder
            
            $vendor->delete();
            return redirect()->route('admin.vendors')->with('success', 'تم حذف المتجر بنجاح');


        }catch(\Exception $ex){
            return $ex;
            return redirect()->route('admin.vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
    }
        public function changestatus($id){
        try{
            $vendor= Vendor::find($id);
            if(!$vendor){
                return redirect()->route('admin.vendors')->with('error', 'عفوا لا يوجد هذا المتجر');
            }
            $status = $vendor->active == 0 ? 1 : 0;
            $vendor->update(['active' => $status]);
            return redirect()->route('admin.vendors')->with('success', 'تم تغيير الحاله بنجاح');

        }catch(\Exception $ex){
            return redirect()->route('admin.vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
