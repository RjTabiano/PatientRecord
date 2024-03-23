<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function staff(){
        return $this->hasMany(Staff::class, 'user_id');
    }

    public function images(){
        return $this->hasMany(Image::class, 'user_id');
    }

    public function doctor(){
        return $this->hasMany(Doctor::class,'user_id');
    }

    public function booking(){
        return $this->hasMany(Booking::class,'user_id');
    }

    public function feedback(){
        return $this->hasMany(Feedback::class,'user_id');
    }
    
    public function patient(){
        return $this->hasMany(Patient::class,'user_id');
    }

    public function schedule(){
        return $this->hasManyThrough(
            Schedule::class,
            Doctor::class,
            'user_id',
            'doctor_id',
            'id', 
            'id'
        );
    }

    public function appointment(){
        return $this->hasManyThrough(
            Appointment::class,
            Doctor::class,
            'user_id',
            'doctor_id',
            'id', 
            'id'
        );
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'email']);
    }

    
}
