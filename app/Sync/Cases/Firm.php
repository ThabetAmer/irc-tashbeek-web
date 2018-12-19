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
            'fname' => [
                'column_name' => 'firm_name',
                'column_type' => 'text',
            ],
            'fcity' => [
                'column_name' => 'city',
                'column_type' => 'text'
            ],
            'sect' => [
                'column_name' => 'sector',
                'column_type' => 'text'
            ],
            'fmob' => [
                'column_name' => 'contact_mobile',
                'column_type' => 'string'
            ]
        ];
    }

    public function formId()
    {
        return '9367515ab3ef207b9935b1318495c2aba5f5a92e';
    }
}