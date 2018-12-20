<?php

namespace App\Http\Resources\CaseResources;

use Carbon\Carbon;
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

        try{
            $data['date_opened_text'] = Carbon::parse($this->date_opened)->format('M d D');
        }catch(\Throwable $e){
            $data['date_opened_text'] = null;
        }
        return $data;
    }
}
