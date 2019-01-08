<?php

namespace Tests;

use App\Models\User;
use App\Sync\DataRequest;
use App\Sync\FormDataRequest;
use App\Sync\UsersRequest;
use App\Sync\UsersSync;
use Tests\Fixtures\Classes\StructureFactory;
use App\Sync\StructureRequest;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function tearDown() {
        \Mockery::close();
//        $this->memoryUsage();
    }

    protected function loginApi($user = null){
        $this->actingAs($user ?? factory(User::class)->create(),'api');
    }

    protected function login($user = null){
        $this->actingAs($user ?? factory(User::class)->create());
    }

    protected function mockStructureRequest()
    {
        $requestMock = \Mockery::mock(StructureRequest::class);

        $structure = json_decode(file_get_contents(base_path('tests/Fixtures/structure.json')),true)['modules'];

        $requestMock->shouldReceive('getModules')->andReturn($structure);

        app()->instance(StructureRequest::class, $requestMock);
    }

    protected function mockFullStructureRequest()
    {
        $requestMock = \Mockery::mock(StructureRequest::class);

        $structure = json_decode(file_get_contents(base_path('tests/Fixtures/full_structure.json')),true)['modules'];

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

    protected function mockUsersRequest($data = null ){

        $requestMock = \Mockery::mock(UsersRequest::class);

        if(!$data){
            $data = json_decode(file_get_contents(base_path('tests/Fixtures/commcare_users.json')),true);
        }

        $requestMock->shouldReceive('data')->andReturn($data);

        app()->instance(UsersRequest::class, $requestMock);
    }

    public function syncStructure(string $caseType)
    {
        $this->mockStructureRequest();

        $factory = app(StructureFactory::class);

        return $factory->make($caseType);
    }


    public function syncUsers()
    {
        $this->mockUsersRequest();

        app(UsersSync::class)->make();
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


    protected function loginAsEso(){
        $user =factory(User::class)->create();
        $this->actingAs($user ?? factory(User::class)->create(),'api');
    }

}
