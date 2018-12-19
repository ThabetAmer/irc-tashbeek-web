<?php

namespace App\Http\Resources;

use App\Models\PropertyMetaData;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CaseDataResource extends ResourceCollection
{
    protected $caseType;

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
        $properties = PropertyMetaData::query()
            ->ofType($this->caseType)
            ->orderBy('order')
            ->get();

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
            'filters' => $filters
        ];
    }

}
