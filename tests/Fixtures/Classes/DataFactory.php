<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace Tests\Fixtures\Classes;


use Tests\Fixtures\Classes\Cases\Firm;
use Tests\Fixtures\Classes\Cases\JobOpening;
use Tests\Fixtures\Classes\Cases\JobSeeker;
use Tests\Fixtures\Classes\Cases\Match;

class DataFactory extends \App\Sync\DataFactory
{
    protected $caseTypes = [
        Firm::class,
        JobSeeker::class,
        JobOpening::class,
        Match::class
    ];
}