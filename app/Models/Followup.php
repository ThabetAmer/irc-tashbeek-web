<?php

namespace App\Models;

use Carbon\Carbon;
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
        $builder->orderBy('followup_date', 'desc');

        $builder->where('followup_date', '<=', now()->toDateString());
    }

    public function scopeUpcomingOnDate(Builder $builder, $date)
    {
        $builder->orderBy('followup_date', 'desc');

        $builder->where('followup_date', '=', $date);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('followups.followup_type', $type);
    }

    public function getDueDateAttribute()
    {
        $followupDate = Carbon::parse($this->followup_date);
        return $followupDate->diffForHumans();
    }

    public function followup()
    {
        return $this->morphTo();
    }
}
