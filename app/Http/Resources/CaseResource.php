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
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return map_options(
            parent::toArray($request),
            $this->resource
        );
    }
}
