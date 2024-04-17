<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class pediatricsConsultation extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'pediatrics_consultation';

    protected $primaryKey = 'id';

    protected $fillable = [
        'history',
        'orders',
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
