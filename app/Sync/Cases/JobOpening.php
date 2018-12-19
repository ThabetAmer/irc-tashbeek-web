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
        // Job opening belongs to firm
        return 'e2a4b4924d5675493681b3f3ce63c4ed94430d8e';
    }

    /**
     * CommCare questions
     *
     * @return array
     */
    public function questions(): array
    {
        return [
            'job_id' => [
                'name' => 'job_id',
                'type' => 'string'
            ],
            'vtit' => [
                'name' => 'job_title',
                'type' => 'text'
            ],
            'vdesc' => [
                'name' => 'job_description',
                'type' => 'text'
            ],
            'coworkers_gender' => [
                'name' => 'gender',
                'type' => 'text'
            ],
            'coworker_nationality' => [
                'name' => 'nationality',
                'type' => 'text'
            ]
        ];
    }
    public function formId()
    {
        return [
            '7c99a14775e998cba17c353a26de887715e32b74'
        ];
    }
}