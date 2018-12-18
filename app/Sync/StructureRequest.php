<?php namespace App\Sync;

use GuzzleHttp\Client;

class StructureRequest
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $url = 'https://www.commcarehq.org/a/billy-excerpt/api/v0.5/application/c61e28d4cb837ae011d1d0ea2ddd2dba';

    /**
     * StructureRequest constructor.
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getModules()
    {
        $this->client= new Client(['verify' => false]);

        $response = $this->client->get($this->url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "ApiKEY " . config('irc.commcare_api_key')
            ],
            ['verify' => false]
        ]);

        $responseContents = $response->getBody()->getContents();

        $responseContents = json_decode($responseContents, true);

        return $responseContents['modules'];
    }
}

