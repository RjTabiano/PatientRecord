<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultationPediatrics extends Model
{
    use HasFactory;
    protected $table = 'consultation';

    protected $primaryKey = 'id';

    protected $fillable = [
        'consultation',
        'created_by',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
   
}
