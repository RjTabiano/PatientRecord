<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Vaccine extends Model
{
    use HasFactory;

    protected $table = 'vaccines';

    protected $primaryKey = 'id';

    protected $fillable = [
        'BCG',
        'Hepatitis_B',
        'DPT',
        'Polio_OPU',
        'Polio_IPU',
        'HiB',
        'PCV',
        'Measles',
        'Varicella',
        'mmra',
        'Hepatitis_A',
        'Meningo',
        'Typhoid',
        'Jap_Enceph',
        'HPV',
        'Flu'
    ];
    
    protected $casts = [
        'BCG' => 'array',
        'Hepatitis_B' => 'array',
        'DPT' => 'array',
        'Polio_OPU' => 'array',
        'Polio_IPU' => 'array',
        'HiB' => 'array',
        'PCV' => 'array',
        'Measles' => 'array',
        'Varicella' => 'array',
        'mmra' => 'array',
        'Hepatitis_A' => 'array',
        'Meningo' => 'array',
        'Typhoid' => 'array',
        'Jap_Enceph' => 'array',
        'HPV' => 'array',
        'Flu' => 'array'
    ];

    public function patientRecord(){
        return $this->belongsTo(PatientRecord::class);
    }

}
