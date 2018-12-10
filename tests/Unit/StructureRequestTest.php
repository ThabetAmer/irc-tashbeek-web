<?php

namespace Tests\Unit;

use App\Sync\StructureRequest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StructureRequestTest extends TestCase
{

    public function test_it_send_modules_request()
    {
        $mock = \Mockery::mock(\GuzzleHttp\Client::class);

        $responseMock = \Mockery::mock(\GuzzleHttp\Psr7\Response::class);
        $streamMock = \Mockery::mock(\GuzzleHttp\Psr7\Stream::class);

        $mock->shouldReceive('get')->andReturn($responseMock);

        $responseMock->shouldReceive('getBody')->andReturn($streamMock);

        $streamMock->shouldReceive('getContents')->andReturn('{"modules":[]}');

        app()->instance(\GuzzleHttp\Client::class,$mock);

        $request = app(StructureRequest::class);

        $this->assertTrue(is_array($request->getModules()));
    }
}
