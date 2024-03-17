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
        'CBC_HgB',
        'plt',
        'DPT',
        'Hct',
        'WBC',
        'Blood_Type',
        'FBS',
        'HBsAg',
        'VDRL',
        'HiV',
        'TT',
        'Urinalysis',
        'Other',
    ];


    public function obgyne(){
        return $this->belongsTo(Obgyne::class);
    }
}
