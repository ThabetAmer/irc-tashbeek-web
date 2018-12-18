<?php namespace App\Sync\Cases;


class JobSeeker extends AbstractCase
{
    public $model = \App\Models\JobSeeker::class;

    /**
     * CommCare module ID
     *
     * @return mixed
     */
    public function id(): string
    {
        return 'c34aa2e60c9858cc95aaeb9a263c2eeba1472e70';
    }

    /**
     * CommCare questions
     *
     * @return array
     */
    public function questions(): array
    {
        return [
            'first_name' => [
                'name' => 'first_name',
                'type' => 'string'
            ],
            'last_name' => [
                'name' => 'last_name',
                'type' => 'string'
            ],

            'city' => [
                'name' => 'city',
                'type' => 'string',
                'has_filter' => true,
            ],
            'district' => [
                'name' => 'district',
                'type' => 'string'
            ],
            'nationality' => [
                'name' => 'nationality',
                'type' => 'string'
            ],
            'age' => [
                'name' => 'age',
                'type' => 'string'
            ],
            'will_work_qiz' => [
                'name' => 'will_work_qiz',
                'type' => 'string'
            ],
            'mobile_num' => [
                'name' => 'mobile_num',
                'type' => 'string'
            ],
            'eso_id' => [
                'name' => 'eso_id',
                'type' => 'text',
                'has_filter' => true,
            ],
            'gps' => [
                'name' => 'gps',
                'type' => 'string'
            ],
        ];
    }

    public function formId()
    {
        return '37f43427d24bd6a294fdd4bf7e3c45fdace489a1';
    }
}