<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecentActivity extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'commcare_id',
        'title',
        'created_at',
        'user_id'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if(empty($model->created_at)){
                $model->created_at = $model->freshTimestamp();
            }
        });
    }


    public function entity()
    {
        return $this->morphTo();
    }
}
