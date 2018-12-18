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
     * @return CaseDataResource
     */
    public function index($caseType, CaseFilter $caseFilter)
    {
        $query = get_case_type_model($caseType)->query();

        $query->filter($caseFilter);

        $results = $query->paginate();

        return new CaseDataResource($results, $caseType);
    }
}
