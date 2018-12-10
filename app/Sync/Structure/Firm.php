<?php namespace App\Sync\Structure;

use App\Firm as FirmModel;

class Firm extends AbstractStructure
{

    public $model = FirmModel::class;

    public $questions = [
        '/Firm_Intake_05/id/fesoid' => [
            'name' => 'fesoid',
            'type' => 'text'
        ],
        '/Firm_Intake_05/id/fidmeth' => [
            'name' => 'fidmeth',
            'type' => 'text'
        ],
        '/Firm_Intake_05/id/rname' => [
            'name' => 'rname',
            'type' => 'text'
        ],
        '/Firm_Intake_05/id/fgps' => [
            'name' => 'fgps',
            'type' => 'text'
        ],
        '/Firm_Intake_05/id/fdate' => [
            'name' => 'fdate',
            'type' => 'date'
        ],
    ];

    /**
     * CommCare module ID
     *
     * @return mixed
     */
    public function id()
    {
        return 'e2a4b4924d5675493681b3f3ce63c4ed94430d8e';
    }
}