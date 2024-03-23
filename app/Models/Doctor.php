<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Doctor extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'doctors';

    protected $primaryKey = 'id';

    protected $fillable = [
        'specialization',
    ];


    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function schedule()
    {
        return $this->belongsToMany(Schedule::class);
    }

    public function appointment()
    {
        return $this->belongsToMany(Appointment::class);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['date', 'time']);
    }
}
