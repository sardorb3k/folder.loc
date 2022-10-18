<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupLevel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'lessonstarttime',
        'lessonendtime',
        'teacher_id',
        'assistant_id',
        'days',
        'level',
    ];
    // Table name
    protected $table = 'group_level';
}
