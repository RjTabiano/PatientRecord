<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ObgyneHistory extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'obgyne_history';

    protected $primaryKey = 'id';

    protected $fillable = [
        'gravidity',
        'parity',
        'OB_score',
        'table',
        'M',
        'I',
        'D',
        'A',
        'S'     
    ];

    
    public function obgyne(){
        return $this->belongsTo(Obgyne::class);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['date', 'time']);
    }
   
}
