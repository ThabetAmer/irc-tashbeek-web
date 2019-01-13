<?php namespace App\Http\Filters;

use Illuminate\Http\Request;
use App\Models\PropertyMetaData;
use Illuminate\Database\Eloquent\Builder;

class MatchesFilter implements FilterInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * CaseFilter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply filter
     *
     * @param Builder $builder
     */
    public function apply(Builder $builder)
    {
        /**
         * Keep it simple for now
         */
        $caseType = case_type($builder->getModel());

        $properties = PropertyMetaData::typeIs($caseType)->get(['column_name', 'attributes'])->keyBy('column_name');

        $filters = array_only($this->filters(), $properties->pluck('column_name')->toArray());

        $this->runFilters($builder, $filters, $properties);
    }

    /**
     * Get filters provided by user
     *
     * @return array
     */
    protected function filters(): array
    {
        $filters = $this->request->input('filters', []);

        return is_array($filters) ? $filters : [];
    }

    /**
     * Apply filter queries
     *
     * @param $builder
     * @param $filters
     * @param $properties
     */
    private function runFilters($builder, $filters, $properties)
    {
        foreach ($filters as $name => $value) {

            if (trim($value) === "" || is_null($value)) {
                continue;
            }

            $filterType = studly_case(array_get($properties->get($name)->attributes, 'type'));

            $searchMethod = "search$filterType";
            if (!method_exists($this, $searchMethod)) {
                $searchMethod = "searchStrict";
            }

            $this->$searchMethod($builder, $name, $value);
        }
    }

    /**
     * Search for partial text or Full text search in future.
     *
     * @param $builder
     * @param $name
     * @param $value
     */
    protected function searchText($builder, $name, $value)
    {
        if (is_array($value)) {
            $value = array_flatten($value);
            $value = reset($value);
        }
        $builder->where($name, 'LIKE', "%$value%");
    }


    /**
     * Search for Date.
     *
     * @param $builder
     * @param $name
     * @param $value
     */
    protected function searchDate($builder, $name, $value)
    {
        $value = explode('T', $value)[0];
        if ($value) {
            $builder->where($name, 'LIKE', "%$value%");
        }
    }


    /**
     * Just search by equality or In
     * @param $builder
     * @param $name
     * @param $value
     */
    protected function searchStrict($builder, $name, $value)
    {
        if (is_array($value)) {
            $builder->whereIn($name, array_flatten($value));
        } else {
            $builder->where($name, $value);
        }
    }
}