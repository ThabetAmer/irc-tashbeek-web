<?php

namespace App\Http\Controllers;

use App\Models\Firm;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use Illuminate\Http\Request;

class ResponseApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @throws \Exception
     */
    public function index(Request $request, $caseType)
    {
        $model = get_case_type_model($caseType);

        return new DataResource($model->paginate(), ['model' => $model]);
    }

}
