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
    protected $fillable = ['doctor_id', 'admin_id','customer_id', 'customer_name','date_birth','gender_id', 'phone',
        'date', 'time','approval_status','appointment_status','insurance_number', 'payment_status','payment_method',
        'customer_notes','doctor_notes','created_at'];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
    public function gender(){
        return $this->belongsTo(Gender::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function payment_method(){
        return $this->belongsTo(PaymentMethod::class);
    }

}
