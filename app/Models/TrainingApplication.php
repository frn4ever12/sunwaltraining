<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TrainingApplication extends Model
{
    protected $fillable = ['user_id', 'training_id', 'fullname_np', 'fullname_eng','father_name','mother_name','grandfather_name','citizenship_no','citizenship_district_id', 'dob_bs', 'dob_ad', 'gender', 'email', 'contact_no', 'mobile_no','photo','nagrita_copy_front','nagrita_copy_back','application_miti_bs','remarks'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->application_no = self::generateApplicationNo();
        });
    }

    public static function generateApplicationNo()
    {
        return DB::transaction(function () {
            $latest = \App\Models\ArthikBarsa::where('status', '1')
                ->lockForUpdate()
                ->first();

            if (!$latest) {
                throw new \Exception("No active fiscal year found.");
            }

            // Convert Nepali digits to English digits and extract year part
            $arthikBarsa = $latest->arthik_barsa;
            $yearPart = preg_replace('/[^0-9]/', '', $arthikBarsa);
            $yearPart = substr($yearPart, 0, 4);

            $lastApp = self::where('application_no', 'like', 'TMUN-' . $yearPart . '-%')
                ->orderBy('id', 'desc')
                ->lockForUpdate()
                ->first();

            $lastNumber = 0;

            if ($lastApp && preg_match('/TMUN-' . $yearPart . '-(\d+)/', $lastApp->application_no, $matches)) {
                $lastNumber = (int) $matches[1];
            }

            $nextNumber = $lastNumber + 1;

            return 'TMUN-' . $yearPart . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
    public function theganaDetail()
    {
        return $this->hasOne(TaTheganaDetail::class);
    }
    public function educationDetails()
    {
        return $this->hasMany(TaEducationDetail::class);
    }
    
    public function anyeBibaranDetails()
    {
        return $this->hasMany(TaAnyeBibaranDetail::class);
    }
    public function experienceDetails()
    {
        return $this->hasMany(TaExperienceDetail::class);
    }
    public function trainingAttendances() {
        return $this->hasMany(TrainingAttendance::class);
    }
}
