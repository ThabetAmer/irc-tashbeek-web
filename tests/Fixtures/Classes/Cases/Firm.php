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
                'name' => 'firm_name',
                'type' => 'text',
                'property' => [
                    'type' => 'select',
                    'options' => []
                ]
            ],
            'fcity' => [
                'name' => 'city',
                'type' => 'text'
            ],
            'sect' => [
                'name' => 'sector',
                'type' => 'text'
            ],
            'fmob' => [
                'name' => 'contact_mobile',
                'type' => 'string'
            ]
        ];
    }
}