<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'description',
        'date',
        'stat_id',
        'priority_id',
        'user_id',
        'comment_id',
    ];

    /**
     * @return relationship of each entities
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class)->withTimestamps();
    }

    public function stat()
    {
        return $this->belongsTo(Stat::class)->withTimestamps();
    }

    public function buildings()
    {
        return $this->belongsToMany(Building::class)->withTimestamps();
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class)->withTimestamps();
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class)->withTimestamps();
    }

    public function approve()
    {
        return $this->belongsTo(Approve::class);
    }
}
