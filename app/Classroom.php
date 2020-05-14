<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = ['name'];

    public function tasks()
    {
        return $this->belongsToMany(Task::class)->withTimestamps();
    }
}
