<?php

namespace Tests\Unit;

use App\Models\JobSeeker;
use App\Sync\DataFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SyncDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_data_can_create_to_database()
    {
        $this->syncStructure('job-seeker');

        $this->mockDataRequest();

        $factory = app(DataFactory::class);

        $factory->make('job-seeker');

        $this->assertCount(40,JobSeeker::all());
    }
}
