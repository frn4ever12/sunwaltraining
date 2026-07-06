<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\Ward;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        $banners = \App\Models\Banner::latest()->take(3)->select('image', 'title')->get();
        $wards = Ward::leftJoin('ta_thegana_details', 'ta_thegana_details.sthyayi_ward_id', '=', 'wards.id')
            ->leftJoin('training_applications', 'training_applications.id', '=', 'ta_thegana_details.training_application_id')
            ->select(
                'wards.id',
                'wards.name'
            )
            ->selectRaw('COUNT(DISTINCT CASE WHEN training_applications.gender = "male" THEN training_applications.id END) as male_count')
            ->selectRaw('COUNT(DISTINCT CASE WHEN training_applications.gender = "female" THEN training_applications.id END) as female_count')
            ->selectRaw('COUNT(DISTINCT training_applications.id) as total_count')
            ->groupBy('wards.id', 'wards.name', 'wards.name_eng')
            ->get();
        $totalCounts = DB::table('wards')
            ->where('wards.status', '1')
            ->leftJoin('ta_thegana_details', 'ta_thegana_details.sthyayi_ward_id', '=', 'wards.id')
            ->leftJoin('training_applications', 'training_applications.id', '=', 'ta_thegana_details.training_application_id')
            ->select(
                DB::raw('COUNT(DISTINCT CASE WHEN training_applications.gender = "male" THEN training_applications.id END) as total_male_count'),
                DB::raw('COUNT(DISTINCT CASE WHEN training_applications.gender = "female" THEN training_applications.id END) as total_female_count'),
                DB::raw('COUNT(DISTINCT training_applications.id) as grand_total_count')
            )
            ->first();
        $trainings = Training::withCount('trainingApplications')->with('user')->whereIn('status', ['upcoming', 'active'])->take(9)->get();

        $samachars = \App\Models\Samachar::select('id', 'title_np', 'miti_bs', 'created_at')
            ->addSelect(DB::raw("'samachar' as type"))
            ->take(2)
            ->latest();

        $notices = \App\Models\Notice::select('id', 'title_np',  'miti_bs', 'created_at')
            ->addSelect(DB::raw("'notice' as type"))
            ->take(2)
            ->latest();

        $latestItems = $samachars->union($notices)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        return view('welcome.welcome', compact('banners', 'wards', 'trainings', 'totalCounts','latestItems'));
    }
}
