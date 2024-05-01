<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftDetail extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'shift_details';
    protected $fillable = ['doctor_id', 'shift_id'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
