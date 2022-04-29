<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function info(Request $request)
    {
        return response()->json($request->user(), 200);
    }
    
        public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ], [
            'phone.required' => 'Phone is required!'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->getMessages(), 403);
        }

        $image = $request->file('image');

        if ($image != null) {
            $data = getimagesize($image);
            $imageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . 'png';
            if (!Storage::disk('public')->exists('profile')) {
                Storage::disk('public')->makeDirectory('profile');
            }
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

        $userDetails = [
            'phone' => $request->phone,
            'image' => $imageName,
            'password' => $pass,
            'updated_at' => now()
        ];
        
        User::where(['id' => $request->user()->id])->update($userDetails);

        return response()->json(["status" =>1,'message' => 'successfully updated!'], 200);
    }
   
    public function update_cm_firebase_token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cm_firebase_token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(Helpers::error_processor($validator), 403);
        }

        DB::table('users')->where('id', $request->user()->id)->update([
            'cm_firebase_token' => $request['cm_firebase_token']
        ]);

        return response()->json(['message' => 'successfully updated!'], 200);
    }
}
