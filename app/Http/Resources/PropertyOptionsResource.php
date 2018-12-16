<?php

namespace App\Http\Resources;

use App\Models\PropertyMetaData;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PropertyOptionsResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'label' => $this['translations'][\App::getLocale()] ?? $this['translations']['en'],
            'value' => $this['value']
        ];
    }

}
