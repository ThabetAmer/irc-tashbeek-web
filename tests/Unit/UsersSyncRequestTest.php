<?php

namespace Tests\Unit;

use App\Sync\UsersRequest;
use Tests\TestCase;

class UsersSyncRequestTest extends TestCase
{

    public function test_it_receives_users()
    {
        $mock = \Mockery::mock(\GuzzleHttp\Client::class);

        $responseMock = \Mockery::mock(\GuzzleHttp\Psr7\Response::class);
        $streamMock = \Mockery::mock(\GuzzleHttp\Psr7\Stream::class);

        $url = 'https://www.commcarehq.org/a/billy-excerpt/api/v0.5/web-user/?limit=80&offset=0';

        $mock->shouldReceive('get')->with($url,[
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "ApiKEY " . config("irc.commcare_api_key")
            ]
        ])->andReturn($responseMock);

        $responseMock->shouldReceive('getBody')->andReturn($streamMock);

        $streamMock->shouldReceive('getContents')->andReturn('{"objects":[],"meta":[]}');

        app()->instance(\GuzzleHttp\Client::class,$mock);

        $request = app(UsersRequest::class);

        $data = $request->data();

        $this->assertArrayHasKey('meta',$data);

        $this->assertArrayHasKey('objects',$data);
    }
}
