<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BaselineDiagnostics extends Model
{
    use HasFactory;

    protected $table = 'baseline_diagnostics';

    protected $primaryKey = 'id';

    protected $fillable = [
        'date',
        'blood_type',
        'FBS',
        'Hct',
        'Hgb',
        'Hct',
        'WBC',
        'Platelet',
        'HIV',
        'first_hr',
        'second_hr',
        'HBsAg',
        'RPR',
        'protein',
        'sugar',
        '2nd_hr',
        'LMP',
        'PMP',
        'AOG',
        'EDD',
        'early_ultrasound',
        'AOG_by_eutz',
        'EDD_by_eutz',
        'Other',
    ];


    public function obgyne(){
        return $this->belongsTo(Obgyne::class);
    }
    
}
