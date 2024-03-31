<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends  Authenticatable
{
    use HasFactory;

    public function setPasswordAttributes($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    protected $primaryKey = 'id';
    protected $table = 'admins';
    public $timestamps = false;
    protected $fillable = [
        'email',
        'password',
        'name',
    ];

    public function appointment(){
        return $this->hasMany(Appointment::class);
    }

}
