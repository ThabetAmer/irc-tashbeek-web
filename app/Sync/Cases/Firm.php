<?php namespace App\Sync\Cases;

use App\Models\Firm as FirmModel;

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
            'fesoid' => [
                'name' => 'fesoid',
                'type' => 'text'
            ],
            'fidmeth' => [
                'name' => 'fidmeth',
                'type' => 'text'
            ],
            'rname' => [
                'name' => 'rname',
                'type' => 'text'
            ],
            'fgps' => [
                'name' => 'fgps',
                'type' => 'text'
            ],
            'fdate' => [
                'name' => 'fdate',
                'type' => 'date'
            ],
        ];
    }

    public function formId()
    {
        return '9367515ab3ef207b9935b1318495c2aba5f5a92e';
    }
}