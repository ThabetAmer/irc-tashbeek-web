<?php

namespace App\Http\Resources;

use App\Models\PropertyOption;
use App\Repositories\PropertyMetaData\PropertyMetaDataRepositoryInterface;
use App\Repositories\PropertyOption\PropertyOptionRepositoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class CaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->mapOptions(
            parent::toArray($request)
        );
    }

    protected function mapOptions($data)
    {

        $fields = app(PropertyMetaDataRepositoryInterface::class)->typeIs(case_type($this->resource));

        $optionsRepository = app(PropertyOptionRepositoryInterface::class);

        foreach($data as $key => $value){

            if(empty($value) && (string) $value !== "0"){
                continue;
            }

            $field = $fields->where('column_name',$key)->first();

            if(!$field){
                continue;
            }

            if($field->type() !== 'select'){
                continue;
            }

            $option = $optionsRepository->CommCareAndPropertyIs($value, $field->id);

            if(!$option){
                continue;
            }

            $name = $option->name();

            if(empty(trim($name))){
               continue;
            }

            $data[$key] = $name;
        }

        return $data;
    }
}
