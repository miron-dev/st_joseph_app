<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['filename'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
