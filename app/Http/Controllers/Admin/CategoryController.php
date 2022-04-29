<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    function index()
    {
        $categories=Category::latest()->paginate(10);
        return view('admin.category.index',compact('categories'));
    }

   

    public function search(Request $request){
        $key = explode(' ', $request['search']);
        $categories=Category::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
            }
        })->get();
        return response()->json([
            'view'=>view('admin.category.partials._table',compact('categories'))->render()
        ]);
    }


    function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Name is required!',
        ]);
        if ($request->has('image')) {
            $image_name = Helpers::upload('category/', 'png', $request->file('image'));
        } else {
            $image_name = 'def.png';
        }

        $category = new Category();
        $category->name = $request->name;
        $category->image = $image_name;
        $category->save();
        return back();
    }

    public function edit($id)
    {
        $category = category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function status(Request $request)
    {
        $category = category::find($request->id);
        $category->status = $request->status;
        $category->save();
        Toastr::success('Category status updated!');
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Name is required!',
        ]);
        $category = category::find($id);
        if ($request->has('image')) {
            $image_name = Helpers::update('category/', $category->image, 'png', $request->file('image'));
        } else {
            $image_name = $category['image'];
        }

        $category->name = $request->name;
        $category->image = $image_name;
        $category->save();
        Toastr::success('Category updated successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        $category = category::find($request->id);
        if (Storage::disk('public')->exists('category/' . $category['image'])) {
            Storage::disk('public')->delete('category/' . $category['image']);
        }
        
            $category->delete();
            Toastr::success('Category removed!');
       
        return back();
    }
}
