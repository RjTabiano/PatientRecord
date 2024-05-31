<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Immunizations extends Model
{
    use HasFactory;

    protected $table = 'immunizations';

    protected $primaryKey = 'id';

    protected $fillable = [
        'TT_1',
        'TT_2',
        'TT_3',
        'TT_4',
        'TT_5',
        'flu',
        'Pneumo',
        'hepa_b',
    ];

    
    public function obgyne(){
        return $this->belongsTo(Obgyne::class);
    }
   
}
