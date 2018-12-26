<?php

namespace App\Http\Controllers;

use App\Http\Filters\CaseFilter;
use App\Http\Resources\CaseDataResource;
use App\Http\Sortable\SortableCase;

class ResponseApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $caseType
     * @param CaseFilter $caseFilter
     * @param SortableCase $sortableCase
     * @return CaseDataResource
     */
    public function index($caseType, CaseFilter $caseFilter, SortableCase $sortableCase)
    {
        $query = get_case_type_model($caseType)->query();

        $query->filter($caseFilter);

        $query->sort($sortableCase);

        $results = $this->handlePagination($query);

        $resourceClass = get_case_type_resource_class($caseType);

        return new $resourceClass($results, $caseType);
    }

    public function handlePagination($query)
    {
        if (request()->get('paginate', "true") === "false") {
            $results = $query->get();
        } else {
            $results = $query->paginate();
        }
        return $results;
    }
}
