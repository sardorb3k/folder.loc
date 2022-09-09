<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lessontime',
        'teacher_id',
        'assistant_id',
        'days',
        'level',
    ];


}
