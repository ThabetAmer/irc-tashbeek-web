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
            'eso_id' => [
                'name' => 'eso_id',
                'type' => 'text',
                'has_filter' => true,
            ],
            'city' => [
                'name' => 'city',
                'type' => 'string',
                'has_filter' => true,
            ],
            'district' => [
                'name' => 'district',
                'type' => 'string'
            ]
        ];
    }

    public function formId()
    {
        return '37f43427d24bd6a294fdd4bf7e3c45fdace489a1';
    }
}