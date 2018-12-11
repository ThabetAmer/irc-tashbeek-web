<?php

namespace Tests;

use App\Sync\StructureRequest;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function tearDown() {
        \Mockery::close();
    }

    protected function mockStructureRequest()
    {
        $requestMock = \Mockery::mock(StructureRequest::class);

        $structure = json_decode(file_get_contents(base_path('tests/Fixtures/structure.json')),true)['modules'];

        $requestMock->shouldReceive('getModules')->andReturn($structure);

        app()->instance(StructureRequest::class, $requestMock);
    }
}
