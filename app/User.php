<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type_id', 'approved_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function tasks()
    {
        return $this->belongsToMany(Task::class)->withTimestamps();
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function types()
    {
        return $this->belongsTo(Type::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function stat_task()
    {
        return $this->belongsTo(Stat_Task::class);
    }

}
