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
        'vaccine',
    ];
    
    protected $casts = ['vaccine' => 'array'];

    public function patientRecord(){
        return $this->belongsTo(PatientRecord::class);
    }
}
