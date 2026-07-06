<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingAttendance extends Model
{
    protected $guarded = [];

    protected $casts = [
        'attendance' => 'array'
    ];
    public function training()
    {
        return $this->belongsTo(Training::class);
    }
    public function trainingApplication()
    {
        return $this->belongsTo(TrainingApplication::class);
    }
}
