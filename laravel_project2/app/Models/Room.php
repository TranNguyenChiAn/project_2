<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'consulting_rooms';
    protected $fillable = ['floor', 'room'];

    public function Doctor(){
        return $this->hasMany(Doctor::class);
    }
}
