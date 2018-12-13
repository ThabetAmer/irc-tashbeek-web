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
            ->get();


        $data = [];
        foreach ($properties as $property) {
            $commcareId = explode('/', $property->commcare_id);
            $data[] = [
                'translations' => $property->attributes['translations'],
                'name' => end($commcareId),
            ];
        }
        return [
            'headers' => $data
        ];
    }

}
