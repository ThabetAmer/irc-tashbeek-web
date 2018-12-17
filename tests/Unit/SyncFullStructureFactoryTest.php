<?php

namespace Tests\Unit;

use App\Models\Form;
use App\Models\PropertyMetaData;
use Tests\TestCase;
use App\Sync\FullStructureFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SyncFullStructureFactoryTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_create_full_structure()
    {
        $this->mockFullStructureRequest();

        $factory = app(FullStructureFactory::class);

        $type = "job-seeker";

        $factory->make($type);

        $form = Form::where('commcare_id', '37f43427d24bd6a294fdd4bf7e3c45fdace489a1')->first();

        $this->assertEquals('Job-seekers Intake Form', $form->name['en']);

        foreach (PropertyMetaData::all() as $property) {
            $this->assertTrue(
                \Illuminate\Support\Facades\Schema::hasColumn('job_seekers', $property->columnName()),
                "Column [" . $property->columnName() . "] not found in job_seekers table");
        }

        $this->assertEquals(312, PropertyMetaData::count());
    }
}
