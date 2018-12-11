<?php namespace App\Sync\Structure;



class JobMatching extends AbstractStructure
{
    public $model = \App\JobMatch::class;

    public $questions = [
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

    public function id()
    {
        return '562c52af2c135d2e1dfa57f15a478c676a6eafee';
    }
}