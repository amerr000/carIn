<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Feedback;
use App\Models\Location;
use App\Models\Car;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'profile_url',
        'phone_number',
        'country_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function feedbacks(){
        return $this->hasMany(Feedback::class);
    }
    public function locations(){
        return $this->hasMany(Location::class);
    }

    public function ownedCars(){
        return $this->hasMany(Car::class);
    }

public function bookedCars()
{
    return $this->belongsToMany(Car::class, 'booking_user_car', 'user_id', 'car_id')
                ->withPivot(['booking_id', 'status'])
                ->withTimestamps();
}

public function bookings()
{
    return $this->belongsToMany(Booking::class, 'booking_user_car', 'user_id', 'booking_id')
                ->withPivot(['car_id', 'status'])
                ->withTimestamps();
}

}
