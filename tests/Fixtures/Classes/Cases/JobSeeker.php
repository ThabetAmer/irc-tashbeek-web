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
                'name' => 'first_name',
                'type' => 'string'
            ],
            'last_name' => [
                'name' => 'last_name',
                'type' => 'string'
            ],
            'city' => [
                'name' => 'city',
                'type' => 'string',
                'has_filter' => true,
            ],
            'district' => [
                'name' => 'district',
                'type' => 'string'
            ],
        ];
    }
}