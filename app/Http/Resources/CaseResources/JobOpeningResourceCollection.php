<?php namespace App\Http\Resources\CaseResources;

use App\Http\Resources\CaseDataResource;
use App\Models\Firm;

class JobOpeningResourceCollection extends CaseDataResource
{
    public $collects = JobOpeningResource::class;


    public function with($request)
    {

        $with = parent::with($request);

        foreach($with['filters'] as $index => $filter){
            if($filter['name'] === 'firm_id'){
                $with['filters'][$index]['options'] = Firm::all()->map(function($firm){
                   return [
                       'label' => $firm->firm_name,
                       'value' => $firm->id
                   ] ;
                });
            }
        }

        return $with;
    }
}