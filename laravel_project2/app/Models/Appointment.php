<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';
    protected $primaryKey = 'id';
    protected $fillable = ['doctor_id', 'admin_id', 'patient_id','appointment_time', 'consulting_rooms','status', 'note', 'created_at', 'updated_at'];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

}
