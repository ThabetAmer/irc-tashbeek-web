<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace App\Http\Filters;


use App\Models\PropertyMetaData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CaseFilter implements FilterInterface
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

    public function apply(Builder $builder)
    {
        /**
         * Keep it simple for now
         */
        $caseType = case_type($builder->getModel());

        $properties = PropertyMetaData::ofType($caseType)->get(['column_name', 'attributes'])->keyBy('column_name');

        $filters = array_only($this->filters(), $properties->pluck('column_name')->toArray());

        foreach ($filters as $name => $value) {
            $filterType = studly_case(array_get($properties->get($name)->attributes, 'type'));
            $searchMethod = "search$filterType";

            if(!method_exists($this,$searchMethod)){
                $searchMethod = "searchStrict";
            }

            $this->$searchMethod($builder,$name,$value);
        }
    }

    protected function filters()
    {
        $filters = $this->request->input('filters', []);

        return is_array($filters) ? $filters : [];
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
        $builder->where($name, 'LIKE', "%$value%");
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