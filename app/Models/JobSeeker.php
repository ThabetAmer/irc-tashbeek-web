<?php namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class JobSeeker extends Model implements SyncableInterface
{
    use Notable,
        Sortable,
        Routable,
        HasFilter,
        MorphToForm,
        HasFollowup,
        HasActivity;

    protected $appends = [
        'details_url'
    ];

    protected $guarded = ['id'];


    public function scopeByCommCareId(Builder $builder, $commCareId)
    {
        $builder->where('commcare_id', $commCareId);
    }

    public function scopeCurrentMonth(Builder $builder)
    {
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();

        $builder->whereBetween('opened_at', [$startOfMonth, $endOfMonth]);
    }

    public function displayName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    public function matches()
    {
        return $this->belongsToMany(JobOpening::class, 'matches')->withPivot(['is_candidate']);
    }

    public function basicInfo()
    {
        return $this->only(['age', 'gender', 'city']);
    }
}