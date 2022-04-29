<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\AdminSetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSettingsController extends Controller
{
    public function system_index()
    {
        return view('admin.admin-settings.system_index');
    }
    public function backend_setup(Request $request)
    {
        DB::table('admin_settings')->updateOrInsert(['key' => 'footer_text'], [
            'value' => $request['footer_text'],
        ]);

        DB::table('admin_settings')->updateOrInsert(['key' => 'pagination_limit'], [
            'value' => $request['pagination_limit'],
        ]);
       

        Toastr::success('Settings updated!');
        return back();
    }
   
    public function terms_and_conditions()
    {
        $tnc = AdminSetting::where(['key' => 'terms_and_conditions'])->first();
        if ($tnc == false) {
            AdminSetting::insert([
                'key'   => 'terms_and_conditions',
                'value' => '',
            ]);
        }
        return view('admin.admin-settings.terms-and-conditions', compact('tnc'));
    }

    public function terms_and_conditions_update(Request $request)
    {
        AdminSetting::where(['key' => 'terms_and_conditions'])->update([
            'value' => $request->tnc,
        ]);

        Toastr::success('Terms and Conditions updated!');
        return back();
    }

    public function privacy_policy()
    {
        $data = AdminSetting::where(['key' => 'privacy_policy'])->first();
        if ($data == false) {
            $data = [
                'key' => 'privacy_policy',
                'value' => '',
            ];
            AdminSetting::insert($data);
        }
        return view('admin.admin-settings.privacy-policy', compact('data'));
    }

    public function privacy_policy_update(Request $request)
    {
        AdminSetting::where(['key' => 'privacy_policy'])->update([
            'value' => $request->privacy_policy,
        ]);

        Toastr::success('Privacy policy updated!');
        return back();
    }


    public function about_us()
    {
        $data = AdminSetting::where(['key' => 'about_us'])->first();
        if ($data == false) {
            $data = [
                'key' => 'about_us',
                'value' => '',
            ];
            AdminSetting::insert($data);
        }
        return view('admin.admin-settings.about-us', compact('data'));
    }

    public function about_us_update(Request $request)
    {
        AdminSetting::where(['key' => 'about_us'])->update([
            'value' => $request->about_us,
        ]);

        Toastr::success('About us updated!');
        return back();
    }

    public function fcm_index()
    {
        if (AdminSetting::where(['key' => 'fcm_topic'])->first() == false) {
            AdminSetting::insert([
                'key'   => 'fcm_topic',
                'value' => '',
            ]);
        }
        if (AdminSetting::where(['key' => 'fcm_project_id'])->first() == false) {
            AdminSetting::insert([
                'key'   => 'fcm_project_id',
                'value' => '',
            ]);
        }
        if (AdminSetting::where(['key' => 'push_notification_key'])->first() == false) {
            AdminSetting::insert([
                'key'   => 'push_notification_key',
                'value' => '',
            ]);
        }

        return view('admin.admin-settings.fcm-index');
    }

    public function update_fcm(Request $request)
    {
        DB::table('admin_settings')->updateOrInsert(['key' => 'fcm_project_id'], [
            'value' => $request['fcm_project_id'],
        ]);

        DB::table('admin_settings')->updateOrInsert(['key' => 'push_notification_key'], [
            'value' => $request['push_notification_key'],
        ]);

        Toastr::success('Settings updated!');
        return back();
    }

   
    public function map_api_setting()
    {
        return view('admin.admin-settings.map-api');
    }
    public function map_api_store(Request $request)
    {
        DB::table('admin_settings')->updateOrInsert(['key' => 'map_api_key'], [
            'value' => $request['map_api_key'],
        ]);
        Toastr::success('Map API updated successfully');
        return back();
    }
}
