<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;


    protected $table = 'doctors';
    public $timestamps = false;
    protected $fillable = ['name', 'email','gender_id', 'specialization_id', 'contact_number','address', 'image'];

    public function gender(){
        return $this->belongsTo(Gender::class);
    }
    public function specialization(){
        return $this->belongsTo(Specialization::class);
    }

}
