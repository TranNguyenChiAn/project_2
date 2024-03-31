<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $table = 'patients';
    protected $fillable = ['name', 'date_birth','gender_id', 'insurance_number', 'phone_number', 'address'];

    public function gender(){
        return $this->belongsTo(Gender::class);
    }
}
