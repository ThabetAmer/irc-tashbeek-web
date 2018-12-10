<?php namespace App\Sync;

class StructureRequest
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var string
     */
    protected $url = 'https://www.commcarehq.org/a/billy-excerpt/api/v0.5/application/c61e28d4cb837ae011d1d0ea2ddd2dba';

    /**
     * @var string
     */
    protected $apiKey = 'issa@souktel.org:f9fcd4b96a0d632d7195b42413417c8ba61a5f5b';

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
        $response = $this->client->get($this->url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "ApiKEY {$this->apiKey}"
            ]
        ]);

        $responseContents = $response->getBody()->getContents();

        $responseContents = json_decode($responseContents, true);

        return $responseContents['modules'];
    }
}
