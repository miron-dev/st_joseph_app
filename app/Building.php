<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = ['name'];

    public function tasks()
    {
        return $this->belongsToMany(Task::class)->withTimestamps();;
    }
}
