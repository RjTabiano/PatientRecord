<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Immunizations extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'immunizations';

    protected $primaryKey = 'id';

    protected $fillable = [
        'TT_1',
        'TT_2',
        'TT_3',
        'TT_4',
        'TT_5',
        'flu',
        'Pneumo',
        'hepa_b',
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
