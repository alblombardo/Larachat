<?php

namespace App;

use App\Notifications\MyResetPassword;
use App\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->surname;

    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify((new MyResetPassword($token)));
    }

    public function messages()
    {
        $this->hasMany(Message::class);
    }
}
