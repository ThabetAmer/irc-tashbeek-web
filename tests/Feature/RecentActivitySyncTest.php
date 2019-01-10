<?php

namespace Tests\Feature;

use App\Models\RecentActivity;
use Tests\TestCase;
use App\Sync\RecentActivityFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Fixtures\Classes\RecentActivityFactory as RecentActivityFactoryFixture;
class RecentActivitySyncTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_throw_exception()
    {

        $this->expectException(\InvalidArgumentException::class);

        app(RecentActivityFactory::class)->make(
            'something-invalid'
        );
    }

    public function test_it_throw_exception_on_missing_case_type()
    {
        $this->expectException(\InvalidArgumentException::class);

        app(RecentActivityFactoryFixture::class)->make(
            'missing_case_type'
        );
    }

    public function test_it_throw_exception_on_missing_form_id()
    {
        $this->expectException(\InvalidArgumentException::class);

        app(RecentActivityFactoryFixture::class)->make(
            'missing_form_id'
        );
    }

    public function test_it_sync_activities()
    {
        $this->syncStructure('job-seeker');

        $this->syncCaseData('job-seeker');

        $this->mockFormRequest();

        app(RecentActivityFactory::class)->make(
            'job-seeker-monthly-followup'
        );

        $this->assertCount(1, RecentActivity::all());
    }
}
