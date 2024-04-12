<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'shifts';
    protected $primaryKey = 'id';
    protected $fillable = ['start_time','end_time', 'doctor_id'];

    public function doctor(){
        return $this->hasMany(Doctor::class);
    }
}
