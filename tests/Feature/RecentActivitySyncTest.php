<?php

namespace Tests\Feature;

use App\Models\JobSeeker;
use App\Models\RecentActivity;
use App\Sync\RecentActivityFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecentActivitySyncTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_sync_users()
    {
        $this->syncStructure('job-seeker');

        $this->syncCaseData('job-seeker');

        $this->mockFormRequest();

        app(RecentActivityFactory::class)->make(
            'job-seeker', '1C0909C3-286E-4EAA-BB12-79D5758366BE'
        );

        $this->assertCount(1, RecentActivity::all());
    }
}
