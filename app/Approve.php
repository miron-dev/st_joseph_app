<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approve extends Model
{
    protected $fillable = ['name'];

    public function task()
    {
        return $this->belongsto(Task::class);
    }
}
