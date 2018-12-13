<?php

namespace App\Http\Controllers;

use App\Models\Firm;
use App\Http\Controllers\Controller;
use App\Http\Resources\CaseDataResource;
use Illuminate\Http\Request;

class ResponseApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $caseType
     * @return CaseDataResource
     */
    public function index($caseType)
    {
        $model = get_case_type_model($caseType);

        return new CaseDataResource($model->paginate(), $caseType);
    }
}
