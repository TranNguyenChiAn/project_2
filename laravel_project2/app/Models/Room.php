<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Comment\Doc;

class Room extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'consulting_rooms';
    protected $fillable = ['floor', 'room_name'];

    public function doctor(){
        return $this->hasMany(Doctor::class);
    }
}
