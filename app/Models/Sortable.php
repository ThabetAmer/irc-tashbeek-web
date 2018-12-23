<?php namespace App\Models;

use App\Http\Sortable\SortableInterface;
use Illuminate\Database\Eloquent\Builder;

trait Sortable
{
    /**
     * @param Builder $builder
     * @param SortableInterface $sortable
     */
    public function scopeSort(Builder $builder, SortableInterface $sortable)
    {
        return $sortable->handle($builder);
    }
}