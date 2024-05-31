<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ObgyneHistory extends Model
{
    use HasFactory;

    protected $table = 'obgyne_history';

    protected $primaryKey = 'id';

    protected $fillable = [
        'gravidity',
        'parity',
        'OB_score',
        'table',
        'M',
        'I',
        'D',
        'A',
        'S'     
    ];

    
    public function obgyne(){
        return $this->belongsTo(Obgyne::class);
    }
   
   
}
