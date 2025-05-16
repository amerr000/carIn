<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Booking extends Model
{
    public function usersBooking()
    {
        return $this->belongsToMany(User::class, 'booking_user_car', 'booking_id', 'user_id')
                    ->withPivot(['car_id', 'status'])
                    ->withTimestamps();
    }

    public function bookedCars()
    {
        return $this->belongsToMany(Car::class, 'booking_user_car', 'booking_id', 'car_id')
                    ->withPivot(['user_id', 'status'])
                    ->withTimestamps();
    }
}
