<?php namespace App\Http\Filters;

use Illuminate\Http\Request;
use App\Models\PropertyMetaData;
use Illuminate\Database\Eloquent\Builder;

class UserFilter implements FilterInterface
{

    protected $validFilters = ['name', 'email'];
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
        $filters = $this->getFilters();
        foreach ($filters as $key => $value) {
            $builder = $builder->where($key, 'LIKE', "%$value%");
        }
    }

    protected function getFilters()
    {
        $filters = $this->request->get('filters', []);

        if (!is_array($filters)) {
            $filters = [$filters];
        }

        $filters = array_filter($filters, function ($item) {
            return !is_null($item) and !in_array($item, $this->validFilters);
        });

        return $filters;
    }


}