<?php namespace App\Sync\Cases;

class Match extends AbstractCase
{
    public $model = \App\Models\Match::class;

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
            'eso_id' => [
                'name' => 'eso_id',
                'type' => 'text'
            ],
            'beneficiary_id_uuid' => [
                'name' => 'beneficiary_id_uuid',
                'type' => 'text'
            ],
            'application_method' => [
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