<?php namespace App\Http\Sortable;

use Illuminate\Database\Eloquent\Builder;

interface SortableInterface
{
    public function handle(Builder $builder);
}