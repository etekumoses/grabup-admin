<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Notification;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
    function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if($request->has('search'))
        {
            $key = explode(' ', $request['search']);
           $notifications = Notification::where(function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->orWhere('title', 'like', "%{$value}%");
                        }
            });
            $query_param = ['search' => $request['search']];
        }else{
           $notifications = new Notification;
        }
        $notifications = $notifications->latest()->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin.notification.index', compact('notifications','search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ], [
            'title.required' => 'title is required!',
        ]);


        $notification = new Notification;
        $notification->title = $request->title;
        $notification->description = $request->description;
        $notification->save();

        try {
            Helpers::send_push_notif_to_topic($notification);
        } catch (\Exception $e) {
            Toastr::warning('Push notification failed!');
        }

        Toastr::success('Notification sent successfully!');
        return back();
    }

    public function edit($id)
    {
        $notification = Notification::find($id);
        return view('admin.notification.edit', compact('notification'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'title is required!',
        ]);

        $notification = Notification::find($id);

        

        $notification->title = $request->title;
        $notification->description = $request->description;
        $notification->save();
        Toastr::success('Notification updated successfully!');
        return back();
    }

    public function status(Request $request)
    {
        $notification = Notification::find($request->id);
        $notification->save();
        Toastr::success('Notification status updated!');
        return back();
    }

    public function delete(Request $request)
    {
        $notification = Notification::find($request->id);
        $notification->delete();
        Toastr::success('Notification removed!');
        return back();
    }
}
