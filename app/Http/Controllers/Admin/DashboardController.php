<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Job;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $data = self::job_stats_data();

        $data['users'] = User::count();
        $data['jobs'] = Job::count();

        $jobrecords = [];
        for ($i = 1; $i <= 12; $i++) {
            $from = date('Y-' . $i . '-01');
            $to = date('Y-' . $i . '-30');
            $jobrecords[$i] = Job::whereBetween('created_at', [$from, $to])->count();
        }

        return view('admin.dashboard', compact('data', 'jobrecords'));
    }

    public function job_stats(Request $request)
    {
        session()->put('statistics_type', $request['statistics_type']);
        $data = self::job_stats_data();

        return response()->json([
            'view' => view('admin.partials._dashboard-job-stats', compact('data'))->render()
        ], 200);
    }

    public function job_stats_data()
    {
        $today = session()->has('statistics_type') && session('statistics_type') == 'today' ? 1 : 0;
        $this_month = session()->has('statistics_type') && session('statistics_type') == 'this_month' ? 1 : 0;

        $job = Job::when($today, function ($query) {
            return $query->whereDate('created_at', \Carbon\Carbon::today());
        })
            ->when($this_month, function ($query) {
                return $query->whereMonth('created_at', Carbon::now());
            })
            ->count();
            
            $category = Category::when($today, function ($query) {
            return $query->whereDate('created_at', \Carbon\Carbon::today());
        })
            ->when($this_month, function ($query) {
                return $query->whereMonth('created_at', Carbon::now());
            })
            ->count();

        $all = Job::all()->count();
        $data = [
            'all' => $all,
            'category'=>$category

        ];

        return $data;
    }
}
