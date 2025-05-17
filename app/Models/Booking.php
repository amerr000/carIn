<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Booking extends Model
{
    

    public function bookedCars()
    {
        return $this->belongsToMany(Car::class)
                    ->withPivot(['status'])
                    ->withTimestamps();
    }
}
