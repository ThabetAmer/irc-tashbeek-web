<?php

namespace Tests\Unit;

use App\PropertyMetaData;
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
            Schema::hasTable(app(\App\JobSeeker::class)->getTable())
        );
    }

    public function test_it_creates_a_table_column()
    {
        $this->createSchema();

        $this->assertTrue(
            Schema::hasColumn(app(\App\JobSeeker::class)->getTable(), 'tn5')
        );

        $this->assertTrue(
            Schema::hasColumn(app(\App\JobSeeker::class)->getTable(), 'tnstart')
        );

        $this->assertTrue(
            Schema::hasColumn(app(\App\JobSeeker::class)->getTable(), 'tn6_other')
        );
    }

    public function test_it_creates_property_meta_data()
    {
        $this->createSchema();

        $properties = PropertyMetaData::all();

        $this->assertCount(3, $properties);

        $this->assertEquals('/JS_Training_01/tn/tn5', $properties->get(0)->commcare_id );

        $this->assertEquals('/JS_Training_01/tn/tn6_other', $properties->get(1)->commcare_id );

        $this->assertEquals('/JS_Training_01/tn/tnstart', $properties->get(2)->commcare_id );
    }

    public function createSchema()
    {
        $this->mockStructureRequest();

        app(StructureFactory::class)->make('job-seeker');
    }
}
