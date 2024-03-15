<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function patientRecord(){
        return $this->hasMany(PatientRecord::class, 'patient_id');
    }

    public function obgyne(){
        return $this->hasMany(Obgyne::class);
    }
    
    public function consultationPediatrics(){
        return $this->hasMany(consultationPediatrics::class);
    }
    
    public function appointment(){
        return $this->hasMany(Appointment::class);
    }
}
