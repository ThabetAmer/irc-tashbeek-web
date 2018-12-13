<?php

namespace Tests\Unit;

use App\Sync\Schema;
use Illuminate\Support\Facades\Schema as LaravelSchema;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchemaTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_create_a_table()
    {
        $tableName = 'sample_table';

        app(Schema::class)->generate($tableName,[
            [
                'name' => 'first_name',
                'type' => 'string'
            ]
        ]);


        $this->assertTrue(LaravelSchema::hasTable($tableName));

        $this->assertTrue(LaravelSchema::hasColumn($tableName,'id'));

        $this->assertTrue(LaravelSchema::hasColumn($tableName,'first_name'));

        $this->assertTrue(LaravelSchema::hasColumn($tableName,'commcare_id'));

        $this->assertTrue(LaravelSchema::hasColumn($tableName,'created_at'));

        $this->assertTrue(LaravelSchema::hasColumn($tableName,'updated_at'));
    }

    public function test_it_update_columns_when_they_are_exists()
    {
        $tableName = 'sample_table';

        app(Schema::class)->generate($tableName,[
            [
                'name' => 'first_name',
                'type' => 'string'
            ]
        ]);

        app(Schema::class)->generate($tableName,[
            [
                'name' => 'first_name',
                'type' => 'string'
            ],
            [
                'name' => 'last_name',
                'type' => 'string'
            ]
        ]);


        $this->assertTrue(LaravelSchema::hasTable($tableName));

        $this->assertTrue(LaravelSchema::hasColumn($tableName,'id'));

        $this->assertTrue(LaravelSchema::hasColumn($tableName,'first_name'));

        $this->assertTrue(LaravelSchema::hasColumn($tableName,'last_name'));

        $this->assertTrue(LaravelSchema::hasColumn($tableName,'commcare_id'));

        $this->assertTrue(LaravelSchema::hasColumn($tableName,'created_at'));

        $this->assertTrue(LaravelSchema::hasColumn($tableName,'updated_at'));

    }
}
