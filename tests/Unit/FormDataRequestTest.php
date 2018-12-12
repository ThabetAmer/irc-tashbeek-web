<?php

namespace Tests\Unit;

use App\Sync\FormDataRequest;
use Tests\TestCase;

class FormDataRequestTest extends TestCase
{
    public function test_it_send_request_to_pull_forms_data()
    {
        $mock = \Mockery::mock(\GuzzleHttp\Client::class);

        $responseMock = \Mockery::mock(\GuzzleHttp\Psr7\Response::class);
        $streamMock = \Mockery::mock(\GuzzleHttp\Psr7\Stream::class);

        $url = 'https://www.commcarehq.org/a/billy-excerpt/api/v0.5/form?limit=40&offset=0';

        $mock->shouldReceive('get')->with($url,[
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "ApiKEY " . config("irc.commcare_api_key")
            ]
        ])->andReturn($responseMock);

        $responseMock->shouldReceive('getBody')->andReturn($streamMock);

        $streamMock->shouldReceive('getContents')->andReturn('{"objects":[],"meta":[]}');

        app()->instance(\GuzzleHttp\Client::class,$mock);

        $request = app(FormDataRequest::class);

        $data = $request->data();

        $this->assertArrayHasKey('meta',$data);

        $this->assertArrayHasKey('objects',$data);
    }
}
