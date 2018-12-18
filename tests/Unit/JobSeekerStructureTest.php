<?php

namespace Tests\Unit;

use App\Models\PropertyMetaData;
use App\Models\PropertyOption;
use App\Sync\Cases\JobSeeker;
use App\Sync\StructureFactory;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobSeekerStructureTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_table()
    {
        $this->createSchema();

        $this->assertTrue(
            Schema::hasTable(app(\App\Models\JobSeeker::class)->getTable())
        );
    }

    public function test_it_creates_a_table_column()
    {
        $this->createSchema();

        $this->assertTrue(
            Schema::hasColumn(app(\App\Models\JobSeeker::class)->getTable(), 'eso_id')
        );

        $this->assertTrue(
            Schema::hasColumn(app(\App\Models\JobSeeker::class)->getTable(), 'city')
        );

        $this->assertTrue(
            Schema::hasColumn(app(\App\Models\JobSeeker::class)->getTable(), 'district')
        );
    }

    public function test_it_creates_property_meta_data()
    {
        $this->createSchema();

        $properties = PropertyMetaData::all();

        $this->assertCount(count(app(JobSeeker::class)->questions()), $properties);
//
//        $this->assertEquals('eso_id', $properties->get(0)->commcare_id);
//
//        $this->assertEquals('city', $properties->get(1)->commcare_id);
//
//        $this->assertEquals('district', $properties->get(2)->commcare_id);
    }

    public function test_it_creates_property_options_data()
    {
        $this->createSchema();

        $propertiesOptions = PropertyOption::all();

        $this->assertCount(4, $propertiesOptions);
//
//        $this->assertEquals('mafraq', $propertiesOptions->get(0)->commcare_id);
//
//        $this->assertEquals('amman', $propertiesOptions->get(1)->commcare_id);
//
//        $this->assertEquals('irbid', $propertiesOptions->get(2)->commcare_id);
//
//        $this->assertEquals('zarqa', $propertiesOptions->get(3)->commcare_id);

    }
    

    public function createSchema()
    {
        $this->mockStructureRequest();

        app(StructureFactory::class)->make('job-seeker');
    }
}
