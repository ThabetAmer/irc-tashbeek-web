<?php namespace App\Sync\Structure;

class JobSeeker extends AbstractStructure
{
    public $model = \App\JobSeeker::class;

    public $questions = [
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

    public function id()
    {
        return 'c34aa2e60c9858cc95aaeb9a263c2eeba1472e70';
    }
}