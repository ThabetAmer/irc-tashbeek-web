<?php namespace App\Sync\Cases;

class JobMatching extends AbstractCase
{
    public $model = \App\JobMatch::class;

    /**
     * CommCare module ID
     *
     * @return mixed
     */
    public function id(): string
    {
        return '562c52af2c135d2e1dfa57f15a478c676a6eafee';
    }

    /**
     * CommCare questions
     *
     * @return array
     */
    public function questions(): array
    {
        return  [
            '/JS_Application_01/eso_id' => [
                'name' => 'eso_id',
                'type' => 'text'
            ],
            '/JS_Application_01/eso_id/beneficiary_id_uuid' => [
                'name' => 'beneficiary_id_uuid',
                'type' => 'text'
            ],
            '/JS_Application_01/js/application_method' => [
                'name' => 'application_method',
                'type' => 'text'
            ],
        ];
    }

    public function caseType(): string
    {
        return 'match';
    }
}