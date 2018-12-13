<?php

namespace Tests\Unit;

use App\Models\Form;
use App\Sync\StructureFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SyncStructureTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_factory_can_use_null_case()
    {
        $this->mockStructureRequest();

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
        $this->mockStructureRequest();

        $factory = app(StructureFactory::class);

        $type = "job-seeker";

        $factory->make($type);

        $this->assertTrue(true);
    }

    public function test_a_jobseeker_is_valid_case()
    {
        $this->mockStructureRequest();

        $factory = app(StructureFactory::class);

        $type = "job-seeker";

        $factory->make($type);

        $this->assertTrue(true);
    }

    public function test_a_job_opening_is_valid_case()
    {
        $this->mockStructureRequest();

        $factory = app(StructureFactory::class);

        $type = "job-opening";

        $factory->make($type);

        $this->assertTrue(true);
    }

    public function test_a_firm_is_valid_case()
    {
        $this->mockStructureRequest();

        $factory = app(StructureFactory::class);

        $type = "firm";

        $factory->make($type);

        $this->assertTrue(true);
    }

    public function test_it_create_related_forms_with_structure()
    {
        $this->mockStructureRequest();

        $factory = app(StructureFactory::class);

        $type = "job-seeker";

        $factory->make($type);

        $form = Form::where('commcare_id','37f43427d24bd6a294fdd4bf7e3c45fdace489a1')->first();

        $this->assertEquals('Job-seekers Intake Form' ,$form->name['en']);
    }
}