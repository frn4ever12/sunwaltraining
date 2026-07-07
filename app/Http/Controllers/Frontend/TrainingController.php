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

    public function calendarEvents()
    {
        $trainings = Training::select('id', 'name_np', 'name_eng', 'start_miti_bs', 'end_miti_bs', 'start_miti_ad', 'end_miti_ad', 'status')
            ->where('status', '!=', 'dismissed')
            ->get();

        $events = [];
        foreach ($trainings as $training) {
            $events[] = [
                'id' => $training->id,
                'title' => $training->name_np ?? $training->name_eng,
                'start' => $training->start_miti_ad,
                'end' => $training->end_miti_ad,
                'start_bs' => $training->start_miti_bs,
                'end_bs' => $training->end_miti_bs,
                'backgroundColor' => $this->getStatusColor($training->status),
                'borderColor' => $this->getStatusColor($training->status),
                'url' => route('training.show', $training->id),
                'extendedProps' => [
                    'status' => $training->status,
                    'status_np' => __('messages.' . $training->status)
                ]
            ];
        }

        return response()->json($events);
    }

    private function getStatusColor($status)
    {
        return match($status) {
            'active' => '#28a745',
            'upcoming' => '#ffc107',
            'completed' => '#6c757d',
            default => '#007bff',
        };
    }
}
