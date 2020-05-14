<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['description'];

    public function task()
    {
        return $this->belongsTo(Task::class)->withTimestamps();;
    }
}
