<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    // Training Reports
    public function trainingList()
    {
        $query = \App\Models\Training::query();
        
        if (!empty(request()->input('name_np'))) {
            $query->where('name_np', 'like', '%' . request()->input('name_np') . '%');
        }
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('start_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('end_miti_bs', '<=', request()->input('end_miti_bs'));
        }
        if (!empty(request()->input('category'))) {
            $query->where('category_id', request()->input('category'));
        }
        if (!empty(request()->input('status'))) {
            $query->where('status', request()->input('status'));
        }

        $trainings = $query->select('id', 'name_np', 'name_eng', 'start_miti_bs', 'end_miti_bs', 'start_samaya', 'end_samaya', 'status', 'available_seats', 'category_id')
            ->orderBy('start_miti_bs', 'desc')
            ->get();

        $categories = \App\Models\Category::all();

        return view('admin.reports.training.list', compact('trainings', 'categories'));
    }

    public function trainingProgress()
    {
        $query = \App\Models\Training::query();
        
        if (!empty(request()->input('name_np'))) {
            $query->where('name_np', 'like', '%' . request()->input('name_np') . '%');
        }
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('start_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('end_miti_bs', '<=', request()->input('end_miti_bs'));
        }

        $trainings = $query->withCount('trainingApplications')
            ->select('id', 'name_np', 'start_miti_bs', 'end_miti_bs', 'status', 'available_seats')
            ->orderBy('start_miti_bs', 'desc')
            ->get();

        return view('admin.reports.training.progress', compact('trainings'));
    }

    public function completedTraining()
    {
        $query = \App\Models\Training::query();
        
        if (!empty(request()->input('name_np'))) {
            $query->where('name_np', 'like', '%' . request()->input('name_np') . '%');
        }
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('start_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('end_miti_bs', '<=', request()->input('end_miti_bs'));
        }

        $trainings = $query->where('status', 'completed')
            ->select('id', 'name_np', 'start_miti_bs', 'end_miti_bs', 'available_seats')
            ->orderBy('end_miti_bs', 'desc')
            ->get();

        return view('admin.reports.training.completed', compact('trainings'));
    }

    public function trainingSummary()
    {
        $query = \App\Models\Training::query();
        
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('start_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('end_miti_bs', '<=', request()->input('end_miti_bs'));
        }

        $totalTrainings = $query->count();
        $completedTrainings = (clone $query)->where('status', 'completed')->count();
        $upcomingTrainings = (clone $query)->where('status', 'upcoming')->count();
        $ongoingTrainings = (clone $query)->where('status', 'ongoing')->count();
        
        $totalApplications = \App\Models\TrainingApplication::whereHas('training', function($q) use ($query) {
            if (!empty(request()->input('start_miti_bs'))) {
                $q->whereDate('start_miti_bs', '>=', request()->input('start_miti_bs'));
            }
            if (!empty(request()->input('end_miti_bs'))) {
                $q->whereDate('end_miti_bs', '<=', request()->input('end_miti_bs'));
            }
        })->count();

        $summary = [
            'total_trainings' => $totalTrainings,
            'completed_trainings' => $completedTrainings,
            'upcoming_trainings' => $upcomingTrainings,
            'ongoing_trainings' => $ongoingTrainings,
            'total_applications' => $totalApplications,
        ];

        return view('admin.reports.training.summary', compact('summary'));
    }

    // Application Reports
    public function receivedApplications()
    {
        $query = \App\Models\TrainingApplication::query();
        
        if (!empty(request()->input('fullname_np'))) {
            $query->where('fullname_np', 'like', '%' . request()->input('fullname_np') . '%');
        }
        if (!empty(request()->input('application_no'))) {
            $query->where('application_no', 'like', '%' . request()->input('application_no') . '%');
        }
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('application_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('application_miti_bs', '<=', request()->input('end_miti_bs'));
        }
        if (!empty(request()->input('status'))) {
            $query->where('status', request()->input('status'));
        }

        $applications = $query->with(['training', 'user'])
            ->select('id', 'application_no', 'fullname_np', 'fullname_eng', 'email', 'contact_no', 'training_id', 'user_id', 'status', 'submitted_at', 'application_miti_bs')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.reports.application.received', compact('applications'));
    }

    public function approvedApplications()
    {
        $query = \App\Models\TrainingApplication::query();
        
        if (!empty(request()->input('fullname_np'))) {
            $query->where('fullname_np', 'like', '%' . request()->input('fullname_np') . '%');
        }
        if (!empty(request()->input('application_no'))) {
            $query->where('application_no', 'like', '%' . request()->input('application_no') . '%');
        }
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('application_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('application_miti_bs', '<=', request()->input('end_miti_bs'));
        }

        $applications = $query->where('status', 'approved')
            ->with(['training', 'user'])
            ->select('id', 'application_no', 'fullname_np', 'fullname_eng', 'email', 'contact_no', 'training_id', 'user_id', 'submitted_at', 'application_miti_bs')
            ->orderBy('submitted_at', 'desc')
            ->get();

        return view('admin.reports.application.approved', compact('applications'));
    }

    public function rejectedApplications()
    {
        $query = \App\Models\TrainingApplication::query();
        
        if (!empty(request()->input('fullname_np'))) {
            $query->where('fullname_np', 'like', '%' . request()->input('fullname_np') . '%');
        }
        if (!empty(request()->input('application_no'))) {
            $query->where('application_no', 'like', '%' . request()->input('application_no') . '%');
        }
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('application_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('application_miti_bs', '<=', request()->input('end_miti_bs'));
        }

        $applications = $query->where('status', 'rejected')
            ->with(['training', 'user'])
            ->select('id', 'application_no', 'fullname_np', 'fullname_eng', 'email', 'contact_no', 'training_id', 'user_id', 'submitted_at', 'application_miti_bs', 'remarks')
            ->orderBy('submitted_at', 'desc')
            ->get();

        return view('admin.reports.application.rejected', compact('applications'));
    }

    public function pendingApplications()
    {
        $query = \App\Models\TrainingApplication::query();
        
        if (!empty(request()->input('fullname_np'))) {
            $query->where('fullname_np', 'like', '%' . request()->input('fullname_np') . '%');
        }
        if (!empty(request()->input('application_no'))) {
            $query->where('application_no', 'like', '%' . request()->input('application_no') . '%');
        }
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('application_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('application_miti_bs', '<=', request()->input('end_miti_bs'));
        }

        $applications = $query->where('status', 'pending')
            ->with(['training', 'user'])
            ->select('id', 'application_no', 'fullname_np', 'fullname_eng', 'email', 'contact_no', 'training_id', 'user_id', 'submitted_at', 'application_miti_bs')
            ->orderBy('submitted_at', 'desc')
            ->get();

        return view('admin.reports.application.pending', compact('applications'));
    }

    // Participant Reports
    public function participantList()
    {
        $query = \App\Models\TrainingApplication::query();
        
        if (!empty(request()->input('fullname_np'))) {
            $query->where('fullname_np', 'like', '%' . request()->input('fullname_np') . '%');
        }
        if (!empty(request()->input('gender'))) {
            $query->where('gender', request()->input('gender'));
        }
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('application_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('application_miti_bs', '<=', request()->input('end_miti_bs'));
        }

        $participants = $query->with(['training', 'user'])
            ->where('status', 'approved')
            ->select('id', 'application_no', 'fullname_np', 'fullname_eng', 'gender', 'email', 'contact_no', 'training_id', 'user_id', 'application_miti_bs', 'dob_bs')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.reports.participant.list', compact('participants'));
    }

    public function participantByTraining()
    {
        $query = \App\Models\Training::query();
        
        if (!empty(request()->input('name_np'))) {
            $query->where('name_np', 'like', '%' . request()->input('name_np') . '%');
        }
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('start_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('end_miti_bs', '<=', request()->input('end_miti_bs'));
        }

        $trainings = $query->withCount(['trainingApplications' => function($q) {
                $q->where('status', 'approved');
            }])
            ->select('id', 'name_np', 'start_miti_bs', 'end_miti_bs', 'available_seats')
            ->orderBy('start_miti_bs', 'desc')
            ->get();

        return view('admin.reports.participant.by-training', compact('trainings'));
    }

    public function participantByWard()
    {
        $query = \App\Models\TrainingApplication::query();
        
        if (!empty(request()->input('fullname_np'))) {
            $query->where('fullname_np', 'like', '%' . request()->input('fullname_np') . '%');
        }
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('application_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('application_miti_bs', '<=', request()->input('end_miti_bs'));
        }

        $participants = $query->with(['training', 'user'])
            ->where('status', 'approved')
            ->select('id', 'application_no', 'fullname_np', 'fullname_eng', 'training_id', 'user_id', 'application_miti_bs')
            ->orderBy('created_at', 'desc')
            ->get();

        // Group by ward if available in user data
        $byWard = $participants->groupBy(function($item) {
            return $item->user->ward ?? 'Unknown';
        });

        return view('admin.reports.participant.by-ward', compact('byWard'));
    }

    public function participantByGender()
    {
        $query = \App\Models\TrainingApplication::query();
        
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('application_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('application_miti_bs', '<=', request()->input('end_miti_bs'));
        }

        $maleCount = (clone $query)->where('gender', 'male')->where('status', 'approved')->count();
        $femaleCount = (clone $query)->where('gender', 'female')->where('status', 'approved')->count();
        $otherCount = (clone $query)->where('gender', 'other')->where('status', 'approved')->count();
        $totalCount = $query->where('status', 'approved')->count();

        $genderStats = [
            'male' => $maleCount,
            'female' => $femaleCount,
            'other' => $otherCount,
            'total' => $totalCount,
        ];

        return view('admin.reports.participant.by-gender', compact('genderStats'));
    }

    public function participantByAge()
    {
        $query = \App\Models\TrainingApplication::query();
        
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('application_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('application_miti_bs', '<=', request()->input('end_miti_bs'));
        }

        $participants = $query->where('status', 'approved')
            ->select('dob_bs')
            ->get();

        $ageGroups = [
            '18-25' => 0,
            '26-35' => 0,
            '36-45' => 0,
            '46-55' => 0,
            '56+' => 0,
        ];

        foreach ($participants as $participant) {
            if ($participant->dob_bs) {
                $age = $this->calculateAge($participant->dob_bs);
                if ($age >= 18 && $age <= 25) $ageGroups['18-25']++;
                elseif ($age >= 26 && $age <= 35) $ageGroups['26-35']++;
                elseif ($age >= 36 && $age <= 45) $ageGroups['36-45']++;
                elseif ($age >= 46 && $age <= 55) $ageGroups['46-55']++;
                elseif ($age >= 56) $ageGroups['56+']++;
            }
        }

        return view('admin.reports.participant.by-age', compact('ageGroups'));
    }

    public function participantByInclusion()
    {
        $query = \App\Models\TrainingApplication::query();
        
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('application_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('application_miti_bs', '<=', request()->input('end_miti_bs'));
        }

        $participants = $query->where('status', 'approved')
            ->with('user')
            ->get();

        $inclusionStats = [
            'dalit' => 0,
            'janajati' => 0,
            'madhesi' => 0,
            'brahmin' => 0,
            'other' => 0,
        ];

        foreach ($participants as $participant) {
            if ($participant->user && $participant->user->caste) {
                $caste = strtolower($participant->user->caste);
                if (str_contains($caste, 'dalit')) $inclusionStats['dalit']++;
                elseif (str_contains($caste, 'janajati')) $inclusionStats['janajati']++;
                elseif (str_contains($caste, 'madhesi')) $inclusionStats['madhesi']++;
                elseif (str_contains($caste, 'brahmin')) $inclusionStats['brahmin']++;
                else $inclusionStats['other']++;
            }
        }

        return view('admin.reports.participant.by-inclusion', compact('inclusionStats'));
    }

    private function calculateAge($dobBs)
    {
        // Simple age calculation from BS date (assuming format YYYY-MM-DD)
        $currentYear = date('Y');
        $dobYear = substr($dobBs, 0, 4);
        return $currentYear - $dobYear;
    }

    // Attendance Reports
    public function dailyAttendance()
    {
        $query = \App\Models\TrainingAttendance::query();
        
        if (!empty(request()->input('date'))) {
            $query->whereDate('attendance_date', request()->input('date'));
        }
        if (!empty(request()->input('training_id'))) {
            $query->where('training_id', request()->input('training_id'));
        }

        $attendances = $query->with(['training', 'trainingApplication'])
            ->select('id', 'training_id', 'training_application_id', 'attendance_date', 'status', 'remarks')
            ->orderBy('attendance_date', 'desc')
            ->get();

        $trainings = \App\Models\Training::all();

        return view('admin.reports.attendance.daily', compact('attendances', 'trainings'));
    }

    public function monthlyAttendance()
    {
        $query = \App\Models\TrainingAttendance::query();
        
        if (!empty(request()->input('month'))) {
            $query->whereMonth('attendance_date', request()->input('month'));
        }
        if (!empty(request()->input('year'))) {
            $query->whereYear('attendance_date', request()->input('year'));
        }
        if (!empty(request()->input('training_id'))) {
            $query->where('training_id', request()->input('training_id'));
        }

        $attendances = $query->with(['training', 'trainingApplication'])
            ->select('id', 'training_id', 'training_application_id', 'attendance_date', 'status')
            ->orderBy('attendance_date', 'desc')
            ->get();

        $trainings = \App\Models\Training::all();

        return view('admin.reports.attendance.monthly', compact('attendances', 'trainings'));
    }

    public function participantAttendance()
    {
        $query = \App\Models\TrainingAttendance::query();
        
        if (!empty(request()->input('application_no'))) {
            $query->whereHas('trainingApplication', function($q) {
                $q->where('application_no', 'like', '%' . request()->input('application_no') . '%');
            });
        }
        if (!empty(request()->input('start_date'))) {
            $query->whereDate('attendance_date', '>=', request()->input('start_date'));
        }
        if (!empty(request()->input('end_date'))) {
            $query->whereDate('attendance_date', '<=', request()->input('end_date'));
        }

        $attendances = $query->with(['training', 'trainingApplication'])
            ->select('id', 'training_id', 'training_application_id', 'attendance_date', 'status')
            ->orderBy('attendance_date', 'desc')
            ->get();

        return view('admin.reports.attendance.participant', compact('attendances'));
    }

    public function absentList()
    {
        $query = \App\Models\TrainingAttendance::query();
        
        if (!empty(request()->input('date'))) {
            $query->whereDate('attendance_date', request()->input('date'));
        }
        if (!empty(request()->input('training_id'))) {
            $query->where('training_id', request()->input('training_id'));
        }

        $absents = $query->where('status', 'absent')
            ->with(['training', 'trainingApplication'])
            ->select('id', 'training_id', 'training_application_id', 'attendance_date', 'status', 'remarks')
            ->orderBy('attendance_date', 'desc')
            ->get();

        $trainings = \App\Models\Training::all();

        return view('admin.reports.attendance.absent', compact('absents', 'trainings'));
    }

    // Trainer Reports
    public function trainerList()
    {
        $query = \App\Models\User::role('trainer');
        
        if (!empty(request()->input('name'))) {
            $query->where('name', 'like', '%' . request()->input('name') . '%');
        }
        if (!empty(request()->input('email'))) {
            $query->where('email', 'like', '%' . request()->input('email') . '%');
        }

        $trainers = $query->select('id', 'name', 'email', 'contact_no', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.reports.trainer.list', compact('trainers'));
    }

    public function trainerByTraining()
    {
        $query = \App\Models\Training::query();
        
        if (!empty(request()->input('name_np'))) {
            $query->where('name_np', 'like', '%' . request()->input('name_np') . '%');
        }
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('start_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('end_miti_bs', '<=', request()->input('end_miti_bs'));
        }

        $trainings = $query->with('user')
            ->select('id', 'name_np', 'user_id', 'start_miti_bs', 'end_miti_bs')
            ->orderBy('start_miti_bs', 'desc')
            ->get();

        return view('admin.reports.trainer.by-training', compact('trainings'));
    }

    public function trainerPayment()
    {
        $query = \App\Models\Training::query();
        
        if (!empty(request()->input('name_np'))) {
            $query->where('name_np', 'like', '%' . request()->input('name_np') . '%');
        }
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('start_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('end_miti_bs', '<=', request()->input('end_miti_bs'));
        }

        $trainings = $query->with('user')
            ->where('status', 'completed')
            ->select('id', 'name_np', 'user_id', 'start_miti_bs', 'end_miti_bs', 'trainer_fee')
            ->orderBy('end_miti_bs', 'desc')
            ->get();

        return view('admin.reports.trainer.payment', compact('trainings'));
    }

    public function trainerEvaluation()
    {
        $query = \App\Models\Training::query();
        
        if (!empty(request()->input('name_np'))) {
            $query->where('name_np', 'like', '%' . request()->input('name_np') . '%');
        }
        if (!empty(request()->input('start_miti_bs'))) {
            $query->whereDate('start_miti_bs', '>=', request()->input('start_miti_bs'));
        }
        if (!empty(request()->input('end_miti_bs'))) {
            $query->whereDate('end_miti_bs', '<=', request()->input('end_miti_bs'));
        }

        $trainings = $query->with(['user', 'trainingApplications'])
            ->where('status', 'completed')
            ->select('id', 'name_np', 'user_id', 'start_miti_bs', 'end_miti_bs')
            ->orderBy('end_miti_bs', 'desc')
            ->get();

        return view('admin.reports.trainer.evaluation', compact('trainings'));
    }

    // Certificate Reports
    public function issuedCertificates()
    {
        $query = \App\Models\TrainingCertification::query();
        
        if (!empty(request()->input('start_date'))) {
            $query->whereDate('certified_date', '>=', request()->input('start_date'));
        }
        if (!empty(request()->input('end_date'))) {
            $query->whereDate('certified_date', '<=', request()->input('end_date'));
        }
        if (!empty(request()->input('training_id'))) {
            $query->where('training_id', request()->input('training_id'));
        }

        $certifications = $query->with(['training', 'trainingApplication', 'certificate'])
            ->where('status', '1')
            ->select('id', 'training_id', 'training_application_id', 'certificate_id', 'certified_date', 'status')
            ->orderBy('certified_date', 'desc')
            ->get();

        $trainings = \App\Models\Training::all();

        return view('admin.reports.certificate.issued', compact('certifications', 'trainings'));
    }

    public function certificateRegister()
    {
        $query = \App\Models\TrainingCertification::query();
        
        if (!empty(request()->input('start_date'))) {
            $query->whereDate('certified_date', '>=', request()->input('start_date'));
        }
        if (!empty(request()->input('end_date'))) {
            $query->whereDate('certified_date', '<=', request()->input('end_date'));
        }

        $certifications = $query->with(['training', 'trainingApplication', 'certificate'])
            ->where('status', '1')
            ->select('id', 'training_id', 'training_application_id', 'certificate_id', 'certified_date', 'status')
            ->orderBy('certified_date', 'desc')
            ->get();

        return view('admin.reports.certificate.register', compact('certifications'));
    }

    public function certificateDownload()
    {
        $query = \App\Models\TrainingCertification::query();
        
        if (!empty(request()->input('start_date'))) {
            $query->whereDate('certified_date', '>=', request()->input('start_date'));
        }
        if (!empty(request()->input('end_date'))) {
            $query->whereDate('certified_date', '<=', request()->input('end_date'));
        }
        if (!empty(request()->input('training_id'))) {
            $query->where('training_id', request()->input('training_id'));
        }

        $certifications = $query->with(['training', 'trainingApplication', 'certificate'])
            ->where('status', '1')
            ->select('id', 'training_id', 'training_application_id', 'certificate_id', 'certified_date', 'status')
            ->orderBy('certified_date', 'desc')
            ->get();

        $trainings = \App\Models\Training::all();

        return view('admin.reports.certificate.download', compact('certifications', 'trainings'));
    }
}
