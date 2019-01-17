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
        $diffInDays = $followupDate->diffInDays(now());
        if (now()->lt($followupDate)) {
            return trans_choice('irc.after_n_days', $diffInDays + 1, ['value' => $diffInDays + 1]);
        }
        return $diffInDays . ' ' . trans_choice('irc.days_ago', $diffInDays);
    }

    public function followup()
    {
        return $this->morphTo();
    }
}
