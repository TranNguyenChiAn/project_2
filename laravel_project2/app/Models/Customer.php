<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Customer extends Model
{
    use HasFactory;

    public function setPasswordAttributes($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    protected $table = 'customers';
    public $timestamps = false;
    protected $fillable = ['name', 'email','phone', 'address', 'password'];
}
