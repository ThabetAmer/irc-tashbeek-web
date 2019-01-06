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

        return case_resource_collection($caseType, $results, $caseType);
    }

    public function handlePagination($query)
    {
        if (request()->has('paginate') and request()->get('paginate') === "false") {
            $results = $query->get();
        } else {
            $results = $query->paginate($this->perPage());
        }
        return $results;
    }

    protected function perPage()
    {
        $perPage = request("perPage");
        $perPagesLimit = [15,30,50];

        if(!in_array($perPage, $perPagesLimit)){
            $perPage = 15;
        }

        return $perPage;
    }
}
