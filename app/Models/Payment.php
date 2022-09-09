<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    // fillable
    protected $fillable = [
        'student_id',
        'user_id',
        'group_id',
        'payment_date',
        'payment_start',
        'amount',
        'payment_end',
    ];
}