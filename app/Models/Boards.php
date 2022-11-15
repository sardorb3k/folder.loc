<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boards extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'visibility', 'workspace', 'issuer_id', 'order_number', 'board_id'];

    public $timestamps = false;

    public function tasks()
    {
        return $this->hasMany(Task::class)->orderBy('order_number');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
