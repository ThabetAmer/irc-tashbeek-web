<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace Tests\Fixtures\Classes;


use Tests\Fixtures\Classes\Cases\Firm;
use Tests\Fixtures\Classes\Cases\JobOpening;
use Tests\Fixtures\Classes\Cases\JobSeeker;
use Tests\Fixtures\Classes\Cases\Match;

class RecentActivityFactory extends \App\Sync\RecentActivityFactory
{
    const FORMS = [
        'missing_case_type' => [
            'form_id' => '123'
        ],
        'missing_form_id' => [
            'case_type' => '123'
        ],

    ];
}