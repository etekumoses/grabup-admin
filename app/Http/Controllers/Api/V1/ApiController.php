<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Currency;
use App\Model\Job;
use App\Model\Notification;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ApiController extends Controller
{
   
//    postjob
public function postjob(Request $request){
    $response = array("status" => 0, "register" => "Validation error");
    $userid = $request->user()->id;
    $rules = [
               "image" => 'required',
               "title"=> 'required',
               "company"=> 'required',
               "comp_details"=> 'required',
               "role"=> 'required',
               "responsibilities"=> 'required',
               "min_experience"=> 'required',
               "required_skills"=> 'required',
               "work_type"=> 'required',
               "address"=> 'required',
               "country"=> 'required',
               "dead_line"=> 'required',
               "url"=> 'required',
               "category_id"=> 'required'
             ];                    
     $messages = array(
               "image.required" => 'Image is required',
               "title.required"=> 'Title is required',
                "company.required"=> 'Company is required',
               "comp_details.required"=> 'Job description is required',
               "role.required"=> 'Role is required',
               "responsibilities.required"=> 'Responsibilities is required',
               "min_experience.required"=> 'Minimum experience is required',
               "required_skills.required"=> 'Required skill is required',
               "work_type.required"=> 'Select Work type is required',
               "address.required"=> 'Address is required',
               "country.required"=> 'Country is required',
               "dead_line.required"=> 'Application deadline is required',
               "url.required"=> 'Url is required',
               "category_id.required"=> 'Select Category'

     );
     $validator = Validator::make($request->all(), $rules, $messages);
     if ($validator->fails()) {
           $message = '';
           $messages_l = json_decode(json_encode($validator->errors()->messages()), true);
           foreach ($messages_l as $msg) {
                  $message .= $msg[0] . ", ";
           }
           $response['msg'] = $message;
     } else {  
        if ($request->hasFile('image')) 
        {
          $file = $request->file('image');
          $filename = $file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension() ?: 'png';
          $picture = \Carbon\Carbon::now()->toDateString() . "-" . uniqid() . "." .$extension;
        $path = Storage::disk('public')->putFileAs('jobs', new File($file),$picture);
       } 
       else{
           null;
       }
       
                $data=new Job();
                $data->category_id=$request->category_id;
                $data->image=$picture;
                $data->title=$request->title;
                $data->company=$request->company;
                $data->comp_details=$request->comp_details;
                $data->user_id=$userid;
                $data->address=$request->address;
                $data->role=$request->role;
                $data->responsibilities=$request->responsibilities;
                $data->min_experience=$request->min_experience;
                $data->work_type=$request->work_type;
                $data->required_skills=$request->required_skills;
                $data->country=$request->country;
                $data->benefits=$request->benefits;
                $data->min_price=$request->min_price;
                $data->other_details=$request->other_details;
                $data->dead_line=$request->dead_line; 
                $data->url=$request->url;             
                $data->save();
                $response = array("status" =>1, "msg" => "Job Submitted Successfully","data"=>$data->id);
    }
    return response()->json($response);
} 


//
// post reviews for developer
// public function postreview(Request $request){
//     $response = array("status" => 0, "register" => "Validation error");
//     $rules = [
//                'user_id' => 'required',
//                'developer_id' => 'required',
//                'review' => 'required',
//                'ratting' => 'required'                 
//              ];                    
//      $messages = array(
//                'user_id.required' => "user_id is required",
//                'developer_id.required' => "doctor_id is required",
//                'review.required' => "review is required",
//                'ratting.required' => "ratting is required"
//      );
//      $validator = Validator::make($request->all(), $rules, $messages);
//      if ($validator->fails()) {
//            $message = '';
//            $messages_l = json_decode(json_encode($validator->messages()), true);
//            foreach ($messages_l as $msg) {
//                   $message .= $msg[0] . ", ";
//            }
//            $response['msg'] = $message;
//      } else {
//          $data=array();
//          $data=new Review();
//          $data->developer_id=$request->get("developer_id");
//          $data->user_id=$request->get("user_id");
//          $data->review=$request->get("review");
//          $data->ratting=$request->get("ratting");
//          $data->save();
//          $response = array("status" =>1, "msg" => "Review Add Successfully","data"=>$data);
//     }
//    return response()->json($response);
// }

public function getlistofjobs(Request $request){
    $response = array("status" => 0, "msg" => "Validation error");
    $job=Job::where('status','published')->paginate(8);

             if($job){
                foreach ($job as $k) {
                    $k->image=asset('storage/app/public/jobs').'/'.$k->image;
                }
                  $jobs=array($job);
                  $response = array("status" =>1, "msg" => "Jobs Get Successfully","data"=>$jobs);
             }else{
                 $response = array("status" =>0, "msg" => "Data Not Found","data"=>array());
             }
    
   return response()->json($response);
}

public function listofcategory(Request $request){
   $data=Category::select('id','name','image')->get();
   if($data){
        foreach ($data as $k) {
            $k->image=asset('storage/app/public/category').'/'.$k->image;
        }
       $response = array("status" =>1, "msg" => "Category found Successfully","data"=>$data);
   }else{
       $response = array("status" =>0, "msg" => "Data Not Found","data"=>$data);
   }
   return response()->json($response,200);
}


public function categorydetailbyid(Request $request){
    $response = array("status" => 0, "msg" => "Validation error");
    $rules = [
               'category_id' => 'required'          
             ];                    
     $messages = array(
               'category_id.required' => "category id is required"
     );
     $validator = Validator::make($request->all(), $rules, $messages);
     if ($validator->fails()) {
           $message = '';
           $messages_l = json_decode(json_encode($validator->errors()->getMessages()), true);
           foreach ($messages_l as $msg) {
                  $message .= $msg[0] . ", ";
           }
        // foreach ($validator->errors()->getMessages() as $index => $error) {
        //     array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        // }
           $response['msg'] = $message;
     } else {               
              $data=Category::select("id","name","image")->find($request->category_id);
              if($data){
                  $data->image=asset('storage/app/public/category').'/'.$data->image;
                  $response = array("status" =>1, "msg" => "Category get Successfully","data"=>$data);
              }else{
                  $response = array("status" =>0, "msg" => "Data Not Found","data"=>$data);
              }
            
    }
    return response()->json($response);
}

// 
public function getuserlistofjobs(Request $request){
     $response = array("status" => 0, "msg" => "Validation error");
     $past=Job::where("user_id",$request->user_id)->where("date","<",date('Y-m-d'))->paginate(10);

              if($past){
                   $jobs=array("past"=>$past);
                   $response = array("status" =>1, "msg" => "My Jobs Get Successfully","data"=>$jobs);
              }else{
                  $response = array("status" =>0, "msg" => "Data Not Found","data"=>array());
              }
     
    return response()->json($response);
}
// 
public function listofjobsbycategory(Request $request){
        $response = array("status" => 0, "msg" => "Validation error");
     $rules = [
               'category_id' => 'required'          
             ];                    
     $messages = array(
               'category_id.required' => "category_id is required"
     );
     $validator = Validator::make($request->all(), $rules, $messages);
     if ($validator->fails()) {
           $message = '';
           $messages_l = json_decode(json_encode($validator->errors()->getMessages()), true);
           foreach ($messages_l as $msg) {
                  $message .= $msg[0] . ", ";
           }
           $response['msg'] = $message;
     } else {      
              if($request->category_id ==0){
                   $job=Job::paginate(6);
              }else{
                   $job=Job::select("id",
                   "image",
                   "title",
                   "company",
                   "comp_details",
                   "role",
                   "responsibilities",
                   "min_experience",
                   "required_skills",
                   "work_type",
                   "address",
                   "country",
                   "benefits",
                   "min_price",
                   "other_details",
                   "url",
                   "dead_line"
                   )->where("category_id",$request->category_id)->paginate(6);
              }
              if($job){
                   foreach ($job as $k) {
                      $cat=Category::find($k->category_id);
                    //   $k->category_id=$cat->name;
                      $k->image=asset('storage/app/public/jobs').'/'.$k->image;
                      unset($k->category_id);
                      $k->id=$k->user_id;
                      unset($k->user_id);
                   }
                   $response = array("status" =>1, "msg" => "Jobs Get Successfully","data"=>$job);
              }else{
                  $response = array("status" =>0, "msg" => "Data Not Found","data"=>array());
              }
            
    }
    return response()->json($response);
}



// public function showlogin(Request $request){
  
//     $response = array("success" => "0", "register" => "Validation error");
//     $rules = [
//                    'login_type' => 'required',
//                    'device_token' => 'required',
//                    'device_type'=>'required',
//                    'email' => 'required',    
//              ];
//              if($request->input('login_type')=='1'){
//                     $rules['password'] = 'required';
//              }
//              if($request->input('login_type')=='2'||$request->input('login_type')=='3'){
//                      $rules['name']='required';
//              }
            
//      $messages = array(
//                'login_type.required' => "login_type is required",
//                'device_token.required' => "device_token is required",
//                'device_type.required' => "device_type is required",
//                'email.required' => "email is required",
//                'password.required'=>"password is required",                     
//                "name.required"=>"name is required"
//      );
//      $validator = Validator::make($request->all(), $rules, $messages);
//      if ($validator->fails()) {
//            $message = '';
//            $messages_l = json_decode(json_encode($validator->messages()), true);
//            foreach ($messages_l as $msg) {
//                   $message .= $msg[0] . ", ";
//            }
//            $response['register'] = $message;
//      } else {
//                   if($request->input('login_type')=='1'){
//                          $user=User::where("email",$request->get("email"))->where("password",$request->get("password"))->first();
//                              if($user){
//                                           Auth::login($user);
//                                           $gettoken=Token::where("token",$request->get("device_token"))->first();
//                                            if(!$gettoken){
//                                                   $store=new Token();
//                                                   $store->token=$request->get("device_token");
//                                                   $store->type=$request->get("device_type");
//                                                   $store->user_id=$user->id;
//                                                   $store->save();
//                                            }
//                                            else{
//                                                   $gettoken->user_id=$user->id;
//                                                   $gettoken->save();
//                                            }
                                           
                                            
//                                            $gettoken=json_decode($this->pushgettoken($request->get("device_type"))); 
//                                            $user->token=$gettoken->token;                             
//                                            $user->profile_pic=asset('public/upload/profile').'/'.$user->profile_pic;
//                                            $response = array("status" =>1, "msg" => "Login Successfully","data"=>$user);
                          
//                              }
//                            else{
//                                 $response = array("status" =>0, "msg" => "Incorrect Email or password");
//                            }
//                   }
//                   if($request->input('login_type')=='2' || $request->input('login_type')=='3'||$request->input('login_type')=='4'){
//                          $checkuser=User::where("email",$request->get("email"))->first();
//                          if($checkuser){
//                              //login
//                            $imgdata=$checkuser->profile_pic;
//                            Auth::login($checkuser);
//                            $png_url="";
//                            $gettoken=Token::where("token",$request->get("device_token"))->first();
//                                    if(!$gettoken){
//                                           $store=new Token();
//                                           $store->token=$request->get("device_token");
//                                           $store->type=$request->get("device_type");
//                                           $store->user_id=$checkuser->id;
//                                           $store->save();
//                                    }
//                                     else{
//                                           $gettoken->user_id=$checkuser->id;
//                                           $gettoken->save();
//                                    }
                     
                     
                             
//                                 if($request->get("image")!=""){
//                                     $png_url = "profile-".mt_rand(100000, 999999).".png";
//                                     $path = public_path().'/upload/profile/' . $png_url;
//                                     $content=$this->file_get_contents_curl($request->get("image"));
//                                        $savefile = fopen($path, 'w');
//                                        fwrite($savefile, $content);
//                                        fclose($savefile);
//                                        $img=public_path().'/upload/profile/' . $png_url;
//                                      $checkuser->profile_pic=$png_url;
//                                 }
//                                 if($imgdata!=$png_url){
//                                     $image_path = public_path() ."/upload/profile/".$imgdata;
//                                        if(file_exists($image_path)&&$imgdata!="") {
//                                              try {
//                                                     unlink($image_path);
//                                              }
//                                              catch(Exception $e) {
//                                              }                        
//                                        }
//                                 }
                               
//                                 $gettoken=json_decode($this->pushgettoken($request->get("device_type"))); 
//                                 // $checkuser->token=$gettoken->token;
//                                $checkuser->login_type=$request->input('login_type');
//                                $checkuser->save();
//                                 $checkuser->token=$gettoken->token;
//                                $checkuser->profile_pic=asset('public/upload/profile').'/'.$checkuser->profile_pic;
                              
//                       $response = array("status" =>1, "msg" => "Login Successfully","data"=>$checkuser);
//                       return response()->json($response);
//                    }
//                  else{
//                      //register
                    
//                          $png_url="";
//                          if($request->get("image")!=""){
//                               $png_url = "profile-".mt_rand(100000, 999999).".png";
//                               $path = public_path().'/upload/profile/' . $png_url;
//                               $content=$this->file_get_contents_curl($request->get("image"));
//                                          $savefile = fopen($path, 'w');
//                                          fwrite($savefile, $content);
//                                          fclose($savefile);
//                                          $img=public_path().'/upload/profile/' . $png_url;
//                          }
//                          $str=explode(" ", $request->get("name"));
//                          $store=new User();
//                          $store->name=isset($str[0])?$str[0]:"";
//                          $store->email=$request->get("email");
//                          $store->login_type=$request->get("login_type");
//                          $store->profile_pic=$png_url;
//                          $store->usertype='1';
//                          $store->save();
//                          Auth::login($user);
                         
//                                            $gettoken=json_decode($this->gettoken()); 
//                                            $store->token=$gettoken->token;   
//                                             if($store->user_sid){
                                
//                                             }
//                          $gettoken=Token::where("token",$request->get("token"))->update(["user_id"=>$store->id]);
//                           $users=User::find($store->id);
//                           $users->profile_pic=asset('public/upload/profile').'/'.$users->profile_pic;
//                           $gettoken=json_decode($this->pushgettoken($request->get("device_type"))); 
//                           $users->token=$gettoken->token;
//                           $response = array("status" =>1, "msg" => "Login Successfully","data"=>$users);
//                           return response()->json($response);
                   
                     
//                  }
//            }
//      }
//      return response()->json($response);
// } 
    // 
    public function get_notifications(){
        try {
            return response()->json(Notification::get(), 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
    // 
}
