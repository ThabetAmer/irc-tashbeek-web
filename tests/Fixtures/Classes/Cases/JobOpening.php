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
                'column_name' => 'job_id',
                'column_type' => 'string'
            ],
            'vtit' => [
                'column_name' => 'job_title',
                'column_type' => 'text'
            ],
            'vdesc' => [
                'column_name' => 'job_description',
                'column_type' => 'text'
            ],
            'coworkers_gender' => [
                'column_name' => 'gender',
                'column_type' => 'text'
            ],
            'coworker_nationality' => [
                'column_name' => 'nationality',
                'column_type' => 'text'
            ],
            'firm_id' => [
                'column_name' => 'firm_id',
                'column_type' => 'unsignedInteger',
                'valueHandler' => \App\Sync\QuestionHandler\JobOpeningFirmIdHandler::class,
                'property' => true,
                'type' => 'select',
                'translations' => [
                    'en' => 'Firm name',
                    'ara' => 'Firm name'
                ],
            ],
        ];
    }
}