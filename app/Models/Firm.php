<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

class Firm extends Model implements SyncableInterface
{
    use MorphToForm, Routable, HasFilter;

    protected $appends = [
        'details_url'
    ];

    protected $guarded = ['id'];

    public function openings()
    {
        return $this->hasMany(JobOpening::class);
    }

    public function scopeByCommCareId(Builder $builder, $commCareId)
    {
        $builder->where('commcare_id', $commCareId);
    }
}
