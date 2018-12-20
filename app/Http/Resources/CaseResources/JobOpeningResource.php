<?php

namespace App\Http\Resources\CaseResources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobOpeningResource extends JsonResource
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

        $data['firm_id'] = $this->firm ? $this->firm->firm_name : null;

        return $data;
    }
}
