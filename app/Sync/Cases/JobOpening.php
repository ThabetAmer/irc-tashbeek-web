<?php namespace App\Sync\Cases;


class JobOpening extends AbstractCase
{
    public $model = \App\Models\JobOpening::class;

    /**
     * CommCare module ID
     *
     * @return mixed
     */
    public function id(): string
    {
        return 'c8e84a46588b5001be2e593f45034f20a1ff35c2';
    }

    /**
     * CommCare questions
     *
     * @return array
     */
    public function questions(): array
    {
        return [
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
    }
}