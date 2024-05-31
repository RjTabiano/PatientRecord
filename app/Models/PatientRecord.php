<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PatientRecord extends Model
{
    use HasFactory;

    protected $table = 'pediatrics';

    protected $primaryKey = 'id';

    protected $fillable = [
        'type',
        'last_name',
        'first_name',
        'birthdate',
        'time',
        'age',
        'address',
        'mother_name',
        'mother_phone',
        'father_name',
        'father_phone',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function vaccine(){
        return $this->hasMany(Vaccine::class);
    }
    
}
