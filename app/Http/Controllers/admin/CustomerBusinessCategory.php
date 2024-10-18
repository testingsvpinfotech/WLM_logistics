<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session; // Add this line
use Illuminate\Support\Facades\File;
use App\Models\BusinessCategory;

class CustomerBusinessCategory extends Controller
{

    public function index()
    {
        $data = [];
        $data['title'] = 'View Business Category';
        $data['category'] = BusinessCategory::where(['mfd'=>0])->get();
        return view ('admin.BusinessCategory.view_category',$data);
    }
    public function add_category()
    {
        $data = [];
        $data['title'] = "Add Business Category";
        return view('admin.BusinessCategory.add_category',$data);
    }
    public function store_category(Request $request)
    {
        $validation = validator::make($request->all(),
        [
              'category_id'=>'required|numeric',
              'category_name'=> 'required|string|regex:/^[a-zA-Z\s]+$/',
              'business_profile' => 'required',
              'discription'=>'required',
        ]);
        if($validation->passes())
        {
            try{
                if ($request->hasFile('business_profile')) {
                    $file = $request->file('business_profile');
                    $business_profile = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('admin-assets/category'), $business_profile);
                }
                $Data = [
                     'category_id'=>$request->category_id,
                     'category_name'=>$request->category_name,
                     'image'=>$business_profile,
                     'description'=>$request->discription
                ];
              
                DB::beginTransaction();
                $branch =  BusinessCategory::create($Data);
                if ($branch) {
                    DB::commit();
                    $msg =  session()->flash('success', 'Category saved successfully');
                    $responce = [
                        'status'=>'success',
                        'error' => 'Category saved successfully'
                    ];
                    echo json_encode($responce);exit;
                } else {
                    // If creation was not successful, throw an exception
                    throw new \Exception('Data not inserted');
                }
            }catch(\Exception $e){
                DB::rollBack();
                $msg =  session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                $responce = [
                    'status'=>'faild',
                    'error' =>'An error occurred: ' . $e->getMessage()
                ];
                echo json_encode($responce);exit;
            }
        }else{
            $json = [
                'status'=>'false',
                'data'=> $validation->errors()
            ];
        }
        return json_encode($json);exit;
    }
    public function editCategory($id)
    {
        $data['title'] = 'Edit Business Category';
        $data['editData'] = BusinessCategory::find($id);
        return view('admin.BusinessCategory.edit_category',$data);
    }

    public function update_category(Request $request)
    {
        $validation = validator::make($request->all(),
        [
              'category_id'=>'required|numeric',
              'category_name'=> 'required|string|regex:/^[a-zA-Z\s]+$/',
              'discription'=>'required',
        ]);
        if($validation->passes())
        {
            try{
                if ($request->hasFile('business_profile')) {
                    $file = $request->file('business_profile');
                    $business_profile = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('admin-assets/category'), $business_profile);
                }
                $Data = [
                     'category_id'=>$request->category_id,
                     'category_name'=>$request->category_name,
                     'description'=>$request->discription
                ];
                if ($request->hasFile('business_profile')) {
                    $branch_imgae =  BusinessCategory::find($request->id);
                    $file_path = public_path('admin-assets/category/'.$branch_imgae->pan_copy);
                        if (File::exists($file_path)) {
                            File::delete($file_path);
                        }
                    $Data['image'] = $business_profile;
                }
              
                DB::beginTransaction();
                $branch =  BusinessCategory::find($request->id);
                $branch->update($Data);
                $branch->save();
                if ($branch) {
                    DB::commit();
                    $msg =  session()->flash('success', 'Category Update successfully');
                    $responce = [
                        'status'=>'success',
                        'error' => 'Category Update successfully'
                    ];
                    echo json_encode($responce);exit;
                } else {
                    // If creation was not successful, throw an exception
                    throw new \Exception('Data not inserted');
                }
            }catch(\Exception $e){
                DB::rollBack();
                $msg =  session()->flash('faild', 'An error occurred: ' . $e->getMessage());
                $responce = [
                    'status'=>'faild',
                    'error' =>'An error occurred: ' . $e->getMessage()
                ];
                echo json_encode($responce);exit;
            }
        }else{
            $json = [
                'status'=>'false',
                'data'=> $validation->errors()
            ];
        }
        return json_encode($json);exit;
    }


    public function downloadImage($path)
    {
        // Define the path to the image in the public folder
        $filePath = public_path('admin-assets/category/'.$path);
        
        // Return a response that triggers the download
        return response()->download($filePath);
    }

    public function destroyBusiness_cate(Request $request)
    {
        try {
            DB::beginTransaction();
                $post = BusinessCategory::find($request->id);
                $post->update(['mfd' => '1']);
                $post->save();
            DB::commit();
            session()->flash('success', 'Business Category Deleted successfully');
            $responce = [
                'success' => 'Business Category Deleted successfully'
            ];
            echo json_encode($responce);exit;
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('faild', 'An error occurred: ' . $e->getMessage());
            $responce = [
                'error' =>'An error occurred: ' . $e->getMessage()
            ];
            echo json_encode($responce);exit;
        }  
    }
    public function statusBusiness(Request $request)
    {
        try {
            DB::beginTransaction();
                $post = BusinessCategory::find($request->id);
                $post->update(['status' => $request->data]);
                $post->save();
            DB::commit();
            session()->flash('success', 'Business Category Deleted successfully');
            $responce = [
                'status' => 'success',
                'success' => 'Business Category Deleted successfully'
            ];
            echo json_encode($responce);exit;
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('faild', 'An error occurred: ' . $e->getMessage());
            $responce = [
                'error' =>'An error occurred: ' . $e->getMessage()
            ];
            echo json_encode($responce);exit;
        }  
    }

}
