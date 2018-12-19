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
                'column_name' =>  'job_title',
                'column_type' =>  'text',
            ],
            'beneficiary_id_uuid' => [
                'column_name' =>  'beneficiary_id_uuid',
                'column_type' =>  'text'
            ],
            'application_method' => [
                'column_name' =>  'application_method',
                'column_type' =>  'text'
            ],
        ];
    }
}