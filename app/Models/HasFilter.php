<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace App\Models;

use App\Http\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

trait HasFilter
{
    public function scopeFilter(Builder $builder, FilterInterface $filter)
    {
        $filter->apply($builder);
    }
}