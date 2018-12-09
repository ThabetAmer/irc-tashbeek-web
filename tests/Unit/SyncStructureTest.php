<?php

namespace Tests\Unit;

use App\Sync\StructureFactory;
use Tests\TestCase;

class SyncStructureTest extends TestCase
{

    public function test_a_factory_can_use_null_case()
    {
        $factory = app(StructureFactory::class);

        $factory->make();

        // fake assert
        $this->assertTrue(true);
    }

    public function test_a_factory_throw_exception_on_invalid_case()
    {
        $this->expectException(\InvalidArgumentException::class);

        $factory = app(StructureFactory::class);

        $type = "something";

        $factory->make($type);
    }

    public function test_a_factory_has_valid_case()
    {
        $factory = app(StructureFactory::class);

        $type = "jobseeker";

        $factory->make($type);

        $this->assertTrue(true);
    }

    public function test_a_jobseeker_is_valid_case()
    {
        $factory = app(StructureFactory::class);

        $type = "jobseeker";

        $factory->make($type);

        $this->assertTrue(true);
    }

    public function test_a_job_opening_is_valid_case()
    {
        $factory = app(StructureFactory::class);

        $type = "job-opening";

        $factory->make($type);

        $this->assertTrue(true);
    }

    public function test_a_firm_is_valid_case()
    {
        $factory = app(StructureFactory::class);

        $type = "firm";

        $factory->make($type);

        $this->assertTrue(true);
    }

    public function test_a_followup_is_valid_case()
    {
        $factory = app(StructureFactory::class);

        $type = "followup";

        $factory->make($type);

        $this->assertTrue(true);
    }
}