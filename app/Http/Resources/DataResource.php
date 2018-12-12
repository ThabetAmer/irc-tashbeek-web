<?php

namespace App\Http\Resources;

use App\PropertyMetaData;
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

        $this->case = app($data['case']);

        $this->model = $this->case->model;

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
        $caseType = $this->case->caseType();

        $properties = PropertyMetaData::query()
            ->ofType($caseType)
            ->pluck('attributes')
            ->toArray();

        return [
            'headers' => array_pluck($properties, 'translations')
        ];
    }

}
