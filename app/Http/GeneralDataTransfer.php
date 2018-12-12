<?php
/**
 * Created by PhpStorm.
 * User: mohammedsehweil
 * Date: 12/12/18
 * Time: 10:29 AM
 */

namespace App\Http;


use App\Http\Resources\DataResource;
use Illuminate\Database\Eloquent\Model;

class GeneralDataTransfer
{
    public function handle(array $requestData, $case)
    {
        $model = app(app($case)->model);
        return new DataResource($model->paginate(), ['case' => $case]);
    }


}