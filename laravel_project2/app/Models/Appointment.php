<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'appointments';
    protected $primaryKey = 'id';
    protected $fillable = ['doctor_id', 'admin_id','customer_id', 'customer_name','date_birth','gender_id', 'phone','date', 'time','status', 'note', 'room_id', 'timestamp'];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }

}
