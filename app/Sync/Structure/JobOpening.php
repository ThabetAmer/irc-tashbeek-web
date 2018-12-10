<?php namespace App\Sync\Structure;


use App\Job as JobModel;

class JobOpening extends AbstractStructure
{
    public $model = JobModel::class;

    public $questions = [
//        '/Firm_Intake_05/id/fesoid' => [
//            'name' => 'fesoid',
//            'type' => 'text'
//        ],
//        '/Firm_Intake_05/id/fidmeth' => [
//            'name' => 'fidmeth',
//            'type' => 'text'
//        ],
//        '/Firm_Intake_05/id/rname' => [
//            'name' => 'rname',
//            'type' => 'text'
//        ],
//        '/Firm_Intake_05/id/fgps' => [
//            'name' => 'fgps',
//            'type' => 'text'
//        ],
//        '/Firm_Intake_05/id/fdate' => [
//            'name' => 'fdate',
//            'type' => 'date'
//        ],


    ];

    public function id()
    {
        return 'c8e84a46588b5001be2e593f45034f20a1ff35c2';
    }
}