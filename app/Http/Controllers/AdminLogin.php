<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session; // Add this line
use App\Models\UserMaster;
class AdminLogin extends Controller
{
     public function index()
     {
        return view('admin_login');
     }

     public function Login(Request $request)
     {
         $validation = Validator::make($request->all(), [
             'username' => 'required|string',
             'password' => 'required|min:8'
         ]);
     
         // Check if validation passes
         if ($validation->passes()) {
             // dd($request->all());
             $user = UserMaster::where('username', $request->username)->first();
             if(empty($user))
             {
                 $json = [
                     'status' => 'faild',
                     'data'   => 'User Not Exist Please check username'
                 ];
                 return response()->json($json);
             }else{
                 if (Hash::check($request->password, $user->password)) {
                     // Password is correct, proceed with login
                     Session::put(['user' => $user]);                
                     $json = [
                         'status' => 'success',
                         'data'   => 'Login successful.'
                     ];
                     return response()->json($json);
                 } else {
                     // Password is incorrect
                     $json = [
                         'status' => 'faild',
                         'data'   => 'Incorrect password. Please enter the correct password.'
                     ];
                     return response()->json($json);
                 }
             }
         } else {
             // Return JSON response for validation errors
             $json = [
                 'status' => 'false',
                 'data'   => $validation->errors()
             ];
             return response()->json($json);
         }
     }


}
