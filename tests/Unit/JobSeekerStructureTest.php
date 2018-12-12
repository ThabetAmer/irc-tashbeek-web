<?php

namespace Tests\Unit;

use App\Models\PropertyMetaData;
use App\Models\PropertyOption;
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
            Schema::hasColumn(app(\App\Models\JobSeeker::class)->getTable(), 'tn5')
        );

        $this->assertTrue(
            Schema::hasColumn(app(\App\Models\JobSeeker::class)->getTable(), 'tnstart')
        );

        $this->assertTrue(
            Schema::hasColumn(app(\App\Models\JobSeeker::class)->getTable(), 'tn6_other')
        );
    }

    public function test_it_creates_property_meta_data()
    {
        $this->createSchema();

        $properties = PropertyMetaData::all();

        $this->assertCount(3, $properties);

        $this->assertEquals('/JS_Training_01/tn/tn5', $properties->get(0)->commcare_id);

        $this->assertEquals('/JS_Training_01/tn/tn6_other', $properties->get(1)->commcare_id);

        $this->assertEquals('/JS_Training_01/tn/tnstart', $properties->get(2)->commcare_id);
    }

    public function test_it_creates_property_options_data()
    {
        $this->createSchema();

        $propertiesOptions = PropertyOption::all();

        $this->assertCount(8, $propertiesOptions);

        $this->assertEquals('cooking', $propertiesOptions->get(0)->commcare_id);

        $this->assertEquals('sewing', $propertiesOptions->get(1)->commcare_id);

        $this->assertEquals('construction', $propertiesOptions->get(2)->commcare_id);

        $this->assertEquals('production', $propertiesOptions->get(3)->commcare_id);

        $this->assertEquals('farming', $propertiesOptions->get(4)->commcare_id);

        $this->assertEquals('business', $propertiesOptions->get(5)->commcare_id);

        $this->assertEquals('finance_accounting', $propertiesOptions->get(6)->commcare_id);

        $this->assertEquals('other', $propertiesOptions->get(7)->commcare_id);

    }


    public function createSchema()
    {
        $this->mockStructureRequest();

        app(StructureFactory::class)->make('job-seeker');
    }
}
