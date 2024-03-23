<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Schedule extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'schedules';

    protected $primaryKey = 'id';

    protected $fillable = [
        'day',
        'start_time',
        'end_time',
    ];

    protected $casts = ['day' => 'array'];

    public function doctor(){
        return $this->belongsToMany(Doctor::class,'doctor_id');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['date', 'time']);
    }
}
