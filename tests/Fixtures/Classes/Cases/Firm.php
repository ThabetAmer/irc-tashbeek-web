<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace Tests\Fixtures\Classes\Cases;


class Firm extends \App\Sync\Cases\Firm
{
    public function questions(): array
    {
        return [
            'fname' => [
                'column_name' => 'firm_name',
                'column_type' => 'text',
                'property' => [
                    'type' => 'select',
                    'options' => []
                ]
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
}