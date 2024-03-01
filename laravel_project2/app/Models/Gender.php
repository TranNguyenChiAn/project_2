<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $fillable = 'name';
    protected $table = 'genders';

    public function Doctor(){
        return $this->hasMany(Doctor::class);
    }
}
