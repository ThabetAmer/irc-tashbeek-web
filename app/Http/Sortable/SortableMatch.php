<?php namespace App\Http\Sortable;

use App\Models\PropertyMetaData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SortableMatch implements SortableInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * SortableCase constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Builder $builder)
    {

        if (!$this->request->has('sorting.column')) {
            return;
        }

        $columnName = $this->request->input('sorting.column');

        $sortables = [
            'match_status' => 'matches.status'
        ];

        if(!array_key_exists($columnName, $sortables)){
            return ;
        }

        $sortingType = $this->request->input('sorting.type');

        $sortingType = $sortingType === 'desc' ? 'desc' : 'asc';

        $builder->orderBy($sortables[$columnName], $sortingType);
    }
}