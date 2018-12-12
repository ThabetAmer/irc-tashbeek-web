<?php

namespace App\Http\Resources;

use App\Models\PropertyMetaData;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DataResource extends ResourceCollection
{


    protected $model;

    protected $case;

    public function __construct($resource, $data)
    {
        // Ensure you call the parent constructor
        parent::__construct($resource);
        $this->resource = $resource;

        $this->model = $data['model'];

    }


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request)
    {
        $caseType = case_type($this->model);

        $properties = PropertyMetaData::query()
            ->ofType($caseType)
            ->pluck('attributes')
            ->toArray();

        return [
            'headers' => array_pluck($properties, 'translations')
        ];
    }

}
