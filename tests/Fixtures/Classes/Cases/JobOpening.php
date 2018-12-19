<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace Tests\Fixtures\Classes\Cases;


class JobOpening extends \App\Sync\Cases\JobOpening
{
    public function questions(): array
    {
        return [
            'job_id' => [
                'name' => 'job_id',
                'type' => 'string'
            ],
            'vtit' => [
                'name' => 'job_title',
                'type' => 'text'
            ],
            'vdesc' => [
                'name' => 'job_description',
                'type' => 'text'
            ],
            'coworkers_gender' => [
                'name' => 'gender',
                'type' => 'text'
            ],
            'coworker_nationality' => [
                'name' => 'nationality',
                'type' => 'text'
            ]
        ];
    }
}