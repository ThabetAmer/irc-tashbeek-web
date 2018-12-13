<?php

namespace Tests;

use App\Sync\DataRequest;
use App\Sync\FormDataRequest;
use App\Sync\StructureFactory;
use App\Sync\StructureRequest;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function tearDown() {
        \Mockery::close();
//        $this->memoryUsage();
    }

    protected function mockStructureRequest()
    {
        $requestMock = \Mockery::mock(StructureRequest::class);

        $structure = json_decode(file_get_contents(base_path('tests/Fixtures/structure.json')),true)['modules'];

        $requestMock->shouldReceive('getModules')->andReturn($structure);

        app()->instance(StructureRequest::class, $requestMock);
    }


    protected function mockDataRequest(){

        $requestMock = \Mockery::mock(DataRequest::class);

        $data = json_decode(file_get_contents(base_path('tests/Fixtures/job_seeker_json_data.json')),true);

        $requestMock->shouldReceive('data')->andReturn($data);

        app()->instance(DataRequest::class, $requestMock);
    }

    protected function mockFormDataRequest(){

        $requestMock = \Mockery::mock(FormDataRequest::class);

        $data = json_decode(file_get_contents(base_path('tests/Fixtures/forms.json')),true);

        $requestMock->shouldReceive('data')->andReturn($data);

        app()->instance(FormDataRequest::class, $requestMock);
    }

    public function syncStructure(string $caseType)
    {
        $this->mockStructureRequest();

        $factory = app(StructureFactory::class);

        return $factory->make($caseType);
    }

    function memoryUsage() {
        $usage = memory_get_usage(true);
        if ($usage < 1024){
            $usage = $usage." bytes";
        }elseif ($usage < 1048576){
            $usage = round($usage/1024,2)." kilobytes";
        }else{
            $usage = round($usage/1048576,2)." megabytes";
        }

        var_dump($usage);
    }
}
