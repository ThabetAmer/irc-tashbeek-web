<?php

namespace App\Http\Resources;

use App\Repositories\PropertyMetaData\PropertyMetaDataRepositoryInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CaseDataResource extends ResourceCollection
{
    protected $caseType;

    public $collects = CaseResource::class;

    /**
     * DataResource constructor.
     * @param $resource
     * @param $caseType
     */
    public function __construct($resource, $caseType)
    {
        parent::__construct($resource);
        $this->caseType = $caseType;
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
        $properties = app(PropertyMetaDataRepositoryInterface::class)->typeIs($this->caseType);

        $headers = [];
        $filters = [];

        foreach ($properties as $property) {
            $translations = array_get($property->attributes,'translations',[]);

            if(!count($translations)){
                $translations = [
                    'en' => $property->column_name,
                    'ara' => $property->column_name,
                ];
            }

            $headers[] = [
                'translations' => $translations,
                'name' => $property->column_name,
            ];

            $filters[] = [
                'name' => $property->column_name,
                'label' => $translations[\App::getLocale()] ?? array_get($translations,'en', $property->column_name),
                'type' => strtolower($property->attributes['type']) ?? 'text',
                'options' => PropertyOptionsResource::collection(collect($property->attributes['options'] ?? [])),
            ];
        }

        $headers[0]['clickable_from'] = 'details_url';

        return [
            'headers' => $headers,
            'filters' => $filters,
            'sorting' => $this->getSorting($request)
        ];
    }

    protected function getSorting($request)
    {
        $sorting = $request->input('sorting',[]);
        if(!is_array($sorting)){
            $sorting = [];
        }

        return [
            'column' => array_get($sorting,'column'),
            'type' => array_get($sorting,'type'),
        ];
    }

}
