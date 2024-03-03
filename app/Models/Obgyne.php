<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obgyne extends Model
{
    use HasFactory;

    protected $table = 'obgyne';

    protected $primaryKey = 'id';

    protected $fillable = [
        'type',
        'age',
        'civil_status',
        'address',
        'contact_number',
        'occupation',
        'religion',
        'referred_by',
        'emergency_contact_no',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function medicalHistory(){
        return $this->hasMany(MedicalHistory::class);
    }
}
