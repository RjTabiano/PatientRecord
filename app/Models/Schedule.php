<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

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
}
