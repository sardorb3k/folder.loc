<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    /**
     * Table name.
     */
    protected $table = 'attendance';
    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'group_id',
        'mark',
        'attendance_date',
        'updated_at',
    ];
}
