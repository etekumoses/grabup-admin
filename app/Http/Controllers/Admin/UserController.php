<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user_list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $user = User::
                    where(function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->orWhere('username', 'like', "%{$value}%");
                        }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $user = User::all();
        }
        $users = User::latest()->paginate(Helpers::getPagination())->appends($query_param);
        
        return view('admin.users.list', compact('users','search'));
    }

    public function search(Request $request){
        $key = explode(' ', $request['search']);
        $users=User::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('username', 'like', "%{$value}%");
            }
        })->get();
        return response()->json([
            'view'=>view('admin.users.partials._table',compact('users'))->render()
        ]);
    }

    
}
