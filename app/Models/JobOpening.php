<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model implements SyncableInterface
{
    use MorphToForm, HasFilter, Sortable, Notable;

    protected $guarded = ['id'];

    protected $appends = ['matches_url'];

    public $withCount = ['matches','hiredMatches'];

    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }

    public function matches(){
        return $this->belongsToMany(JobSeeker::class,'matches')->withPivot(['status']);
    }

    public function hiredMatches(){
        return $this->matches()->where('matches.status',  Match::STATUS_HIRED);
    }

    public function matchesFromPivot()
    {
        return $this->hasMany(Match::class)->whereNotNull('job_seeker_id');
    }

    public function getMatchesUrlAttribute($value)
    {
        return route('job-openings.match', $this->id);
    }
}
