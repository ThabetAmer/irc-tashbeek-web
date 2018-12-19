<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace Tests\Fixtures\Classes\Cases;


class Match extends \App\Sync\Cases\Match
{
    public function questions(): array
    {
        return  [
            'eso_id' => [
                'name' => 'eso_id',
                'type' => 'text'
            ],
            'beneficiary_id_uuid' => [
                'name' => 'beneficiary_id_uuid',
                'type' => 'text'
            ],
            'application_method' => [
                'name' => 'application_method',
                'type' => 'text'
            ],
        ];
    }
}