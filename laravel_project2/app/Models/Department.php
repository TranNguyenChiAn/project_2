<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['name'];


    public function Doctor(){
        return $this->hasMany(Doctor::class);
    }

}
