<?php namespace App\Http\Resources\CaseResources;

use App\Http\Resources\CaseDataResource;

class FirmResourceCollection extends CaseDataResource
{
    public $collects = FirmResource::class;


    public function with($request)
    {
        $with = parent::with($request);
        $with['headers'][] = [
            'name' => 'openings_count',
            'translations' => [
                'en' => 'Job Openings',
                'ara' => 'Job Openings'
            ]
        ];

        return $with;
    }
}