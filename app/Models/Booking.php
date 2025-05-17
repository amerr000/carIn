<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Booking extends Model
{
    

    public function bookedCars()
    {
        return $this->belongsToMany(Car::class, 'booking_user_car', 'booking_id', 'car_id')
                    ->withPivot(['user_id', 'status'])
                    ->withTimestamps();
    }
}
