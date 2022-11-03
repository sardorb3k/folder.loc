<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'labels', 'deadline', 'users', 'board_id', 'status', 'order_number'];

    protected $table = 'task';

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function board()
    {
        return $this->belongsTo(Boards::class);
    }
}
