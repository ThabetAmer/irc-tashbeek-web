<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Followup extends Model
{

    protected $fillable = [
        'note',
        'user_id',
        'followup_date',
        'followup_period',
        'type'
    ];


    public function scopeUpcoming(Builder $builder)
    {
        $builder->orderBy('followup_date','desc');

        $builder->where('followup_date' , '<=' , now()->toDateString());
    }

    public function scopeUpcomingOnDate(Builder $builder, $date)
    {
        $builder->orderBy('followup_date','desc');

        $builder->where('followup_date' , '=' , $date);
    }

    public function followup()
    {
        return $this->morphTo();
    }
}
