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

        $url = 'https://www.commcarehq.org/a/billy-excerpt/api/v0.5/application/c61e28d4cb837ae011d1d0ea2ddd2dba';

        $mock->shouldReceive('get')->with($url,[
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "ApiKEY " . config("irc.commcare_api_key")
            ],
            ['verify' => false]
        ])->andReturn($responseMock);

        $responseMock->shouldReceive('getBody')->andReturn($streamMock);

        $streamMock->shouldReceive('getContents')->andReturn('{"modules":[]}');

        app()->instance(\GuzzleHttp\Client::class,$mock);

        $request = app(StructureRequest::class);

        $this->assertTrue(is_array($request->getModules()));
    }
}
