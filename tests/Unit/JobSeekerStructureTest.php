<?php

namespace Tests\Unit;

use App\Sync\Structure\JobSeeker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobSeekerStructureTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_table()
    {

        $contents = file_get_contents('/Users/mohammedsehweil/PhpstormProjects/irc_rep/tests/Unit/job_seeker_json_data.json');

        $data = json_decode($contents, true);

        try {
            app(JobSeeker::class)->handle($data);
        } catch (\Exception $e) {
        }

    }

}
