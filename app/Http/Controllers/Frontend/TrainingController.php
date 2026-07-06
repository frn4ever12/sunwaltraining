<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index(Request $request)
    {
        $query=Training::query();
        if (!empty(request()->input('training_name'))) {
            $query->where('name_np', 'like', '%' . request()->input('training_name') . '%');
        }
        if (!empty(request()->input('entry_date'))) {
            $query->whereDate('start_miti_bs', '>=', request()->input('entry_date'));
        }
        if (!empty(request()->input('end_date'))) {
            $query->whereDate('end_miti_bs', '<=', request()->input('end_date'));
        }

        $trainings = $query->where('status', 'upcoming')->select('name_np', 'id', 'trainer_name_np', 'trainer_name_eng','start_miti_bs', 'status')->paginate(12);
        return view('frontend.Training.index', compact('trainings'));
    }
    public function show($id)
    {
        $training = Training::find($id);

        return view('frontend.Training.show', compact('training'));
    }
}
