<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class pediatricsConsultation extends Model
{
    use HasFactory;
    protected $table = 'pediatrics_consultation';

    protected $primaryKey = 'id';

    protected $fillable = [
        'history',
        'orders',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

}
