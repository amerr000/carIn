<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Image;
use App\Models\Booking;

class Car extends Model
{
    protected $fillable=[
         "available",
            "brand",
            "model_name",
            "year",
            "color",
            "milage",
            "location_id",
            "user_id"

    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function bookedCars()
    {
        return $this->belongsToMany(Booking::class)
                    ->withTimestamps();
    }
}
