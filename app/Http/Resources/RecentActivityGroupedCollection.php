<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RecentActivityGroupedCollection extends ResourceCollection
{
    public $collects = RecentActivityResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = collect(parent::toArray($request))
            ->groupBy('created_at_text')->toArray();

        return $this->groupsWithoutKeys($data);
    }

    protected function groupsWithoutKeys($data)
    {
        $final = [];

        foreach($data as $key => $value){
            array_push($final, [
                'name' => $key,
                'items' => $value
            ]);
        }

        return $final;
    }
}
