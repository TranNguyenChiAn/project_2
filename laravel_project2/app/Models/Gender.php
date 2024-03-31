<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $table = 'genders';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function doctor(){
        return $this->hasMany(Doctor::class);
    }

    public function patient(){
        return $this->hasMany(Patient::class);
    }
}
