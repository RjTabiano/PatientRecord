<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class consultationPediatrics extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'consultation';

    protected $primaryKey = 'id';

    protected $fillable = [
        'consultation',
        'created_by',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['date', 'time']);
    }
}
