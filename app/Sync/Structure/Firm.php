<?php namespace App\Sync\Structure;

use App\Firm as FirmModel;

class Firm extends AbstractStructure
{

    public $model = FirmModel::class;


    public $questions = [
    ];


    public function id()
    {
        return 'e2a4b4924d5675493681b3f3ce63c4ed94430d8e';
    }

}