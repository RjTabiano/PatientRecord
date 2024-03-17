<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObgyneHistory extends Model
{
    use HasFactory;

    protected $table = 'obgyne_history';

    protected $primaryKey = 'id';

    protected $fillable = [
        'gravitiy',
        'parity',
        'OB_score',
        'table',
        'Blood_Type',
        'LMP',
        'PMP',
        'AOG',
        'EDD',
        'early_ultrasound',
        'AOG_by_eutz',
        'EDD_by_eutz',
        'TT1',
        'TT2',
        'TT3',
        'TDAP',
        'Flu',
        'HPV',
        'PCV',
        'covid19_brand',
        'primary',
        'booster',
        
    ];
    public function obgyne(){
        return $this->belongsTo(Obgyne::class);
    }
   
}
