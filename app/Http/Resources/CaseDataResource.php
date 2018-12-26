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
        $properties = app(PropertyMetaDataRepositoryInterface::class)->typeIs($this->caseType)->keyBy('column_name');

        $headers = [];
        $columns = [];
        $filters = [];

        $selectedColumns = $this->getSelectedColumns($request, $properties);

        foreach ($properties as $property) {
            $translations = array_get($property->attributes, 'translations', []);

            if (!count($translations)) {
                $translations = [
                    'en' => $property->column_name,
                    'ara' => $property->column_name,
                ];
            }

            if (in_array($property->column_name, $selectedColumns)) {
                $headers[] = [
                    'translations' => $translations,
                    'name' => $property->column_name,
                ];
            }

            $columns[] = [
                'translations' => $translations,
                'name' => $property->column_name,
            ];

            $filters[] = [
                'name' => $property->column_name,
                'label' => $translations[\App::getLocale()] ?? array_get($translations, 'en', $property->column_name),
                'type' => strtolower($property->attributes['type']) ?? 'text',
                'options' => PropertyOptionsResource::collection(collect($property->attributes['options'] ?? [])),
            ];
        }

        $headers[0]['clickable_from'] = 'details_url';

        return [
            'headers' => $headers,
            'filters' => $filters,
            'columns' => $columns,
            'sorting' => $this->getSorting($request, $properties)
        ];
    }

    protected function getSorting($request, $properties)
    {
        $model = get_case_type_model($this->caseType);

        $sorting = $request->input('sorting', []);

        if (!is_array($sorting) || (!in_array(array_get($sorting, 'column'), withCount($model)) and !$properties->has($request->input('sorting.column')))) {
            $sorting = [];
        }

        return [
            'column' => array_get($sorting, 'column'),
            'type' => array_get($sorting, 'type') === 'asc' ? 'asc' : 'desc',
        ];
    }

    protected function getSelectedColumns($request, $properties)
    {
        $columns = [];
        if ($request->has('columns')) {
            if (is_array($request->input('columns'))) {
                $columns = array_flatten($request->input('columns'));
            } else {
                $columns = explode(',', $request->input('columns'));
            }
        }

        if (!is_array($columns)) {
            $columns = [];
        }

        $columns = array_filter($columns, function ($column) use ($properties) {
            return $properties->has($column);
        });

        if (!count($columns)) {
            return $properties->pluck('column_name')->take(14)->toArray();
        }

        return $columns;
    }

}
