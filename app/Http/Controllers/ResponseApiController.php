<?php

namespace App\Http\Controllers;

use App\Http\Filters\CaseFilter;
use App\Http\Resources\CaseDataResource;

class ResponseApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $caseType
     * @param CaseFilter $caseFilter
     * @return CaseDataResource
     */
    public function index($caseType, CaseFilter $caseFilter)
    {
        $query = get_case_type_model($caseType)->query();

        $query->filter($caseFilter);

        $results = $query->paginate();

        $resourceClass = get_case_type_resource_class($caseType);

        if($resourceClass){
            return new $resourceClass($results, $caseType);
        }

        return new CaseDataResource($results, $caseType);
    }
}
