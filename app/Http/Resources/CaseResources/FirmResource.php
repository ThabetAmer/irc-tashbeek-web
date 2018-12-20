<?php

namespace App\Http\Resources\CaseResources;

use Illuminate\Http\Resources\Json\JsonResource;

class FirmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);

        $data['openings_count'] = $this->openings()->count();

        return $data;
    }
}
