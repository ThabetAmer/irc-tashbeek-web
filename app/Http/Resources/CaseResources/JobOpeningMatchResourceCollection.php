<?php namespace App\Http\Resources\CaseResources;

use App\Http\Resources\CaseDataResource;
use App\Models\Firm;

class JobOpeningMatchResourceCollection extends CaseDataResource
{
    public $collects = JobOpeningMatchResource::class;

    public function with($request)
    {
        $with = parent::with($request);

        $with['headers'][] = [
            'label' => trans('irc.jobseeker_status'),
            'name' => 'match_status',
        ];

        $with['filters'][] = [
            'name' => 'match_status',
            'label' => trans('irc.jobseeker_status'),
            'type' => 'select',
            'options' => $this->matchStatuses()
        ];

        return $with;
    }

    protected function matchStatuses()
    {
        $statuses = [];

        foreach(trans('irc.match_statuses') as $key => $value){
            $statuses[] = [
                'label' => $value,
                'value' => $key
            ];
        }

        return $statuses;
    }
}