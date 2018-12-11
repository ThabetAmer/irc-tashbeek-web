<?php namespace App\Sync\Cases;


class JobSeeker extends AbstractCase
{
    public $model = \App\JobSeeker::class;

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
            '/JS_Training_01/tn/tn5' => [
                'name' => 'tn5',
                'type' => 'text'
            ],
            '/JS_Training_01/tn/tnstart' => [
                'name' => 'tnstart',
                'type' => 'date'
            ],
            '/JS_Training_01/tn/tn6_other' => [
                'name' => 'tn6_other',
                'type' => 'text'
            ]
        ];
    }
}