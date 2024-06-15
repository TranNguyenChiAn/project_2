<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Authenticatable
{
    use HasFactory;

    protected $table = 'doctors';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['name', 'email','password','gender_id', 'department_id', 'contact_number', 'room_id','address', 'image', 'isDeleted'];

    public function gender(){
        return $this->belongsTo(Gender::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function appointment(){
        return $this->hasMany(Appointment::class);
    }

    public function shifts()
    {
        return $this->belongsToMany(Shift::class, 'shift_details', 'doctor_id', 'shift_id')->withTimestamps();
    }
}
