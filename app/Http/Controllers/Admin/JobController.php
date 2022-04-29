<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Job;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Rap2hpoutre\FastExcel\FastExcel;

class JobController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.job.index',compact('categories'));
    }
    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $query = Job::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('id', 'like', "%{$value}%")
                        ->orWhere('title', 'like', "%{$value}%")
                        ->orWhere('company', 'like', "%{$value}%");
                }
            })->latest();
            $query_param = ['search' => $request['search']];
        } else {
            $query = Job::latest();
        }
        $jobs = $query->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin.job.list', compact('jobs', 'search'));
    }

    public function search(Request $request)
    {
        $key = explode(' ', $request['search']);
        $Job = Job::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('title', 'like', "%{$value}%");
                $q->orWhere('company', 'like', "%{$value}%");
            }
        })->get();
        return response()->json([
            'view' => view('admin.job.partials._table', compact('job'))->render(),
        ]);
    }


    // testing storing the data
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 
            'category_id' => 'required',
            'title' => 'required',
            'company' => 'required',
            'comp_details' => 'required',
            'role' => 'required',
            'responsibilities'=> 'required',
            'min_experience' => 'required',
            'required_skills' => 'required',
            'work_type' => 'required',
            'image' => 'required',
            'address' => 'required',
            'country' => 'required',
            'dead_line' => 'required',
            'url' => 'required',

        ], [
// 
            'category_id.required' => 'Category is required',
            'title.required' => 'title is required',
            'company.required' => 'Company is required',
            'comp_details.required'=>'company Description is required',
            'role.required' => 'Role is required',
            'responsibilities.required'=> 'responsibility is required',
            'min_experience.required' => 'min experience is required',
            'required_skills.required' => 'required skills are required',
            'work_type.required' => 'work type required',
            'image.required' => 'Image is required',
            'address.required' => 'Address is required',
            'country.required' => 'Country is required',
            'dead_line.required' => 'Dead line is required',
            'url.required' => 'Url is required',
        ]);

        if ($request->has('image')) {
            $image_name = Helpers::upload('jobs/', 'png', $request->file('image'));
        } else {
            $image_name = 'def.png';
        }
        $user =  auth('admin')->user()->id;
        $p = new Job;
        $p->category_id = $request->category_id;
        $p->title = $request->title;
        $p->company = $request->company;
        $p->comp_details = $request->comp_details;
        $p->role = $request->role;
        $p->responsibilities = $request->responsibilities;
        $p->min_experience = $request->min_experience;
        $p->required_skills = $request->required_skills;
        $p->benefits = $request->benefits;
        $p->min_price = $request->min_price;
        $p->other_details = $request->other_details;
        $p->dead_line = $request->dead_line;
        $p->work_type = $request->work_type;
        $p->user_id = $user;
        $p->country = $request->country;
        $p->url = $request->url;
        $p->address = $request->addres;
        $p->image = $image_name;


        if ($validator->getMessageBag()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
        $p->save();
        return response()->json([], 200);
    }

    public function edit($id)
    {
        $job = Job::withoutGlobalScopes()->find($id);

        return view('admin.job.edit', compact('job'));
    }

    public function status(Request $request)
    {
        $job = Job::find($request->id);
        $job->status = $request->status;
        $job->save();
        Toastr::success('Data status updated!');
        return back();
    }



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 
            'category_id' => 'required',
            'title' => 'required',
            'company' => 'required',
            'role' => 'required',
            'responsibilities'=> 'required',
            'min_experience' => 'required',
            'required_skills' => 'required',
            'work_type' => 'required',
            'image' => 'required',
            'address' => 'required',
            'country' => 'required',
            'dead_line' => 'required',
            'url' => 'required',

        ], [
// 
            'category_id.required' => 'Category is required',
            'title.required' => 'title is required',
            'company.required' => 'Company is required',
            'role.required' => 'Role is required',
            'responsibilities.required'=> 'responsibility is required',
            'min_experience.required' => 'min experience is required',
            'required_skills.required' => 'required skills are required',
            'work_type.required' => 'work type required',
            'image.required' => 'Image is required',
            'address.required' => 'Address is required',
            'country.required' => 'Country is required',
            'dead_line.required' => 'Dead line is required',
            'url.required' => 'Url is required',
        ]);

        if ($request->has('image')) {
            $image_name = Helpers::upload('jobs/', 'png', $request->file('image'));
        } else {
            $image_name = 'def.png';
        }

        $user =  auth('admin')->user()->id;
        $p = new Job;
        $p->category_id = $request->category_id;
        $p->title = $request->title;
        $p->company = $request->company;
        $p->comp_details = $request->comp_details;
        $p->role = $request->role;
        $p->responsibilities = $request->responsibilities;
        $p->min_experience = $request->min_experience;
        $p->required_skills = $request->required_skills;
        $p->benefits = $request->benefits;
        $p->min_price = $request->min_price;
        $p->other_details = $request->other_details;
        $p->dead_line = $request->dead_line;
        $p->work_type = $request->work_type;
        $p->user_id = $user;
        $p->country = $request->country;
        $p->address = $request->addres;
        $p->url = $request->url;
        $p->image = $image_name;

         if ($validator->getMessageBag()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
        $p->save();
        return response()->json([], 200);
    }

    public function delete(Request $request)
    {
        $job = Job::find($request->id);
        if (Storage::disk('public')->exists('jobs/' . $job['image'])) {
            Storage::disk('public')->delete('jobs/' . $job['image']);
        }
        $job->delete();
        Toastr::success('Job removed!');
        return back();
    }

    // 
   
   


   
}
