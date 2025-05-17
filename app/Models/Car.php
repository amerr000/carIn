<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Image;
use App\Models\Booking;

class Car extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function bookedCars()
    {
        return $this->belongsToMany(Booking::class, 'booking_user_car', 'car_id', 'booking_id')
                    ->withPivot(['user_id', 'status'])
                    ->withTimestamps();
    }
}
