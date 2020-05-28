<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat_Task extends Model
{
    protected $fillable = [
        'task_id',
        'worker_id',
        'admin_id',
        'done_wordker',
        'done_admin',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
