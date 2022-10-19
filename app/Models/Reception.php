<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;
    protected $table = 'reception';
    // fillable
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'phone_contact',
        'gender',
        'homeaddress',
        'reasontostudy',
        'interests',
        'hear_about',
        'course',
        'birthday',
    ];
}
