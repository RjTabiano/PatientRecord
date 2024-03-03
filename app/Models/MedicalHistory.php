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
        'history',  
    ];
    
    protected $casts = ['history' => 'array'];

    public function obgyne(){
        return $this->belongsTo(Obgyne::class);
    }
}
