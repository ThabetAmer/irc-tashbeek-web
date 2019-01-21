<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model implements SyncableInterface
{
    use MorphToForm, HasFilter, Sortable, Notable;

    protected $guarded = ['id'];

    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }

    public function matches(){
        return $this->belongsToMany(JobSeeker::class,'matches')->withPivot(['status']);
    }

    public function matchesFromPivot()
    {
        return $this->hasMany(Match::class)->whereNotNull('job_seeker_id');
    }
}
