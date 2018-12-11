<?php namespace App\Sync\Cases;

use App\Firm as FirmModel;

class Firm extends AbstractCase
{
    public $model = FirmModel::class;

    /**
     * CommCare module ID
     *
     * @return mixed
     */
    public function id(): string
    {
        return 'e2a4b4924d5675493681b3f3ce63c4ed94430d8e';
    }

    /**
     * CommCare questions
     *
     * @return array
     */
    public function questions(): array
    {
        return [
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
    }
}