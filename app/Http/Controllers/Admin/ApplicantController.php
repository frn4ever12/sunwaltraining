<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingApplication;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index()
    {
        $applicants = TrainingApplication::with(['user', 'training'])
            ->select('id', 'user_id', 'training_id', 'fullname_np', 'fullname_eng', 'email', 'contact_no', 'application_no', 'status', 'submitted_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.applicants.index', compact('applicants'));
    }
}
