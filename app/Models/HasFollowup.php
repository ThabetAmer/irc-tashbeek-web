<?php namespace App\Models;

trait HasFollowup
{
    public function followups()
    {
        return $this->morphMany(Followup::class, 'followup');
    }
}