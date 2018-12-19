<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace Tests\Fixtures\Classes\Cases;


class JobSeeker extends \App\Sync\Cases\JobSeeker
{
    public function questions(): array
    {
        return [
            'first_name' => [
                'column_name' => 'first_name',
                'column_type' =>  'string'
            ],
            'last_name' => [
                'column_name' =>  'last_name',
                'column_type' =>  'string'
            ],
            'city' => [
                'column_name' =>  'city',
                'column_type' =>  'string',
                'has_filter' => true,
            ],
            'district' => [
                'column_name' =>  'district',
                'column_type' =>  'string'
            ],
        ];
    }
}