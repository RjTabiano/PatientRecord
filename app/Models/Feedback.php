<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Feedback extends Model
{
    use HasFactory, LogsActivity;


    protected $table = 'feedbacks';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['date', 'time']);
    }
}
