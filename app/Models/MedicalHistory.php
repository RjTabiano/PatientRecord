<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    use HasFactory;

    protected $table = 'medical_history';

    protected $primaryKey = 'id';

    protected $fillable = [
        'Hypertension',
        'Bronchial_Asthma',
        'Thyroid_Disease',
        'Heart_Disease',
        'Previous_Surgery',
        'Allergy',
        'Family_History',
    ];
    
    protected $casts = [
        'Family_History' => 'array'
    ];
    public function obgyne(){
        return $this->belongsTo(Obgyne::class);
    }
}
