<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class UserAuthController extends Controller
{
//    register
    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
           
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'phone'=>'required',
            'image'=>'required'    
        ], [
                    'f_name.required' => "Firstname is required",
                    'l_name.required'=>"Lastname is required",
                   'email.unique' => 'Email Already exist',
                   'email.required' => "Email are required",  
                   'phone.required' => "Phone Number is required",                    
                   'password.required' => "password is required",
                   'image'=>"image is required"
        ]);

        if ($validator->fails()) {
            
            return response()->json($validator->errors()->getMessages(), 403);
        }

        $image = $request->file('image');
        if ($image != null) {
            $data = getimagesize($image);
            $imageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . 'png';
            $note_img = Image::make($image)->fit($data[0], $data[1])->stream();
            Storage::disk('public')->put('profile/' . $imageName, $note_img);
        } else {
            $imageName = $request->user()->image;
        }

        if ($request['password'] != null && strlen($request['password']) > 5) {
            $pass = bcrypt($request['password']);
        } else {
            $pass = $request->user()->password;
        }

        $temporary_token = Str::random(40);
        $user = User::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'password' => $pass,
            'image'=>$imageName,
            'temporary_token' => $temporary_token,
        ]);
         $token = $user->createToken('userAuth')->accessToken;
        $response = array("status" =>1, "msg" => "Register Successfully","data"=>$user,"token"=>$token);
        return response()->json($response, 200);
    }
// login 
    public function login(Request $request)
    {
        if($request->has('email'))
        {
            $user_id = $request['email'];

            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required|min:6'
            ]);

        }else
        {
            $user_id = $request['email'];

            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required|min:6'
            ]);
        }
        if ($validator->fails()) {
            return response()->json($validator->errors()->getMessages(), 403);
        }
        $user = User::where(['email' => $user_id])->first();
        if (isset($user)) {
            $user->temporary_token = Str::random(40);
            $user->save();
            $data = [
                'email' => $user->email,
                'password' => $request->password
            ];

            if (auth()->attempt($data)) {
                $token = auth()->user()->createToken('userAuth')->accessToken;
                $response = array("status" =>1, "msg" => "Login Successfully","data"=>$user,'token' => $token);
                return response()->json($response, 200);
            }
        }
        $response = array('status' => 0, 'msg' => 'Invalid credential.');
        return response()->json($response, 401);

    }

}

// $validator = Validator::make($request->all(), [
//     'email' => 'required|string|email|max:255',
//     'password' => 'required|string|min:6|confirmed',
// ]);
// if ($validator->fails())
// {
//     return response(['errors'=>$validator->errors()->all()], 422);
// }
// $user = User::where('email', $request->email)->first();
// if ($user) {
//     if (Hash::check($request->password, $user->password)) {
//         $token = $user->createToken('userAuth')->accessToken;
//         $response = ['token' => $token];
//         return response($response, 200);
//     } else {
//         $response = ["message" => "Password mismatch"];
//         return response($response, 422);
//     }
// } else {
//     $response = ["message" =>'User does not exist'];
//     return response($response, 422);
// }
// }