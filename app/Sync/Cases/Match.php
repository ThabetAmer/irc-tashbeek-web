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
                'column_name' => 'eso_id',
                'column_type' => 'text'
            ],
            'beneficiary_id_uuid' => [
                'column_name' => 'beneficiary_id_uuid',
                'column_type' => 'text'
            ],
            'application_method' => [
                'column_name' => 'application_method',
                'column_type' => 'text'
            ],
        ];
    }

    public function caseType(): string
    {
        return 'match';
    }
}