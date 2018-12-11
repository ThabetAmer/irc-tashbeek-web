<?php namespace App\Sync\Structure;



class JobOpening extends AbstractStructure
{
    public $model = \App\JobOpening::class;

    public $questions = [
        '#form/date_required' => [
            'name' => 'date_required',
            'type' => 'date'
        ],
        '#form/job_id' => [
            'name' => 'job_id',
            'type' => 'text'
        ],
        '#form/why_close_job_opening' => [
            'name' => 'why_close_job_opening',
            'type' => 'text'
        ],
    ];

    public function id()
    {
        return 'c8e84a46588b5001be2e593f45034f20a1ff35c2';
    }
}