<?php

namespace Tests\Unit;

use App\Sync\DataRequest;
use Tests\TestCase;

class DataRequestTest extends TestCase
{
    public function test_it_send_modules_request()
    {
        $mock = \Mockery::mock(\GuzzleHttp\Client::class);

        $responseMock = \Mockery::mock(\GuzzleHttp\Psr7\Response::class);
        $streamMock = \Mockery::mock(\GuzzleHttp\Psr7\Stream::class);

        $url = 'https://www.commcarehq.org/a/billy-excerpt/api/v0.5/case/?case_type=job-seeker&limit=40';

        $mock->shouldReceive('get')->with($url,[
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "ApiKEY " . config("irc.commcare_api_key")
            ]
        ])->andReturn($responseMock);

        $responseMock->shouldReceive('getBody')->andReturn($streamMock);

        $streamMock->shouldReceive('getContents')->andReturn('{"objects":[]}');

        app()->instance(\GuzzleHttp\Client::class,$mock);

        $request = app(DataRequest::class);

        $this->assertTrue(is_array($request->data('job-seeker')));
    }
}
