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
        HasFollowup;

    protected $appends = [
      'details_url'
    ];

    protected $guarded = ['id'];


    public function scopeByCommCareId(Builder $builder, $commCareId)
    {
        $builder->where('commcare_id', $commCareId);
    }
}