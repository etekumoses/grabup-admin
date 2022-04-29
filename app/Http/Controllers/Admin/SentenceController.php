<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\CentralLogics\Helpers;
use App\Model\Sentence;
use App\Model\SentenceBulkImport;
use App\Http\Controllers\Controller;
use App\Model\Language;
use Excel;
use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Support\Facades\Validator;

class SentenceController extends Controller
{
    public function index()
    {
        $languages = Language::get();
        return view('admin.sentence.index',compact('languages'));
    }

    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $query = Sentence::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('id', 'like', "%{$value}%")
                        ->orWhere('description', 'like', "%{$value}%");
                }
            })->latest();
            $query_param = ['search' => $request['search']];
        }else{
            $query = Sentence::latest();
        }
        $sentences = $query->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin.sentence.list', compact('sentences','search'));
    }

    public function search(Request $request)
    {
        $key = explode(' ', $request['search']);
        $sentence = Sentence::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('description', 'like', "%{$value}%");
            }
        })->get();
        return response()->json([
            'view' => view('admin.sentence.partials._table', compact('sentence'))->render(),
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'language' =>'required'
        ], [
            'language.required' => 'Language is required!',
            'description.required' => 'Sentence description is required!',
            
        ]);
        $p = new Sentence;
        $p->lan = $request->language;
        $p->sentence = $request->description;
       
        if ($validator->getMessageBag()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
        $p->save();
        return response()->json([], 200);
    }

    public function edit($id)
    {
        $languages = Language::get();
        $sentence = Sentence::withoutGlobalScopes()->find($id);
        return view('admin.sentence.edit', compact('sentence','languages'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'language' =>'required'
        ], [
            'language.required' => 'Language is required!',
            'description.required' => 'Sentence description is required!',
            
        ]);
        $p = Sentence::find($id);
        $p->lan = $request->language;
        $p->sentence = $request->description;
    
        if ($validator->getMessageBag()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
        $p->save();
        return response()->json([], 200);
    }

    public function delete(Request $request)
    {
        $sentence = Sentence::find($request->id);
        $sentence->delete();
        Toastr::success('Sentence removed!');
        return back();
    }
    // upload sentences
    public function upload()
    {
       return view('admin.sentence.upload');
    }

    // bulk upload
    public function bulk_upload(Request $request)
    {
        if($request->hasFile('bulk_file')){
            $import = new SentenceBulkImport;
            Excel::import($import, request()->file('bulk_file'));
          
        }
        return back();
    }
}