<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Staff extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'staffs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'role',
    ];



    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['date', 'time']);
    }
}
