<?php namespace App\Sync\Structure;


use App\Job as JobModel;

class JobOpening extends AbstractStructure
{
    public $model = JobModel::class;

    public $questions = [
    ];

    public function id()
    {
        return 'c8e84a46588b5001be2e593f45034f20a1ff35c2';
    }
    
}