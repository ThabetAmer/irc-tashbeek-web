<?php namespace App\Models;

trait HasActivity
{
    public function recentActivities()
    {
        return $this->morphMany(RecentActivity::class, 'entity');
    }
}