<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lastname',
        'firstname',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRole()
    {
        return $this->role;
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function boards()
    {
        return $this->hasMany(Boards::class)->orderBy('order_number');
    }

    // Avator image
    public function getAvatarAttribute()
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->firstname) . '?s=45&d=mm';
    }

    public function getInitialsAttribute()
    {
        return strtoupper(substr($this->firstname, 0, 1) . substr($this->lastname, 0, 1));
    }

    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    // Avator
    public function getAvator()
    {
        return $this->image;
    }
}
