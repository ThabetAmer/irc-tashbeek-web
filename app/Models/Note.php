<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['note','user_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}