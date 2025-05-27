<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Car;

class Location extends Model
{
    protected $fillable=["longitude","latitude","user_id"];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cars(){
        return $this->hasMany(Car::class);
    }
}
