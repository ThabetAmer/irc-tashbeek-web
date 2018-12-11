<?php namespace App\Sync;

class DataRequest
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var string
     */
    protected $url = 'https://www.commcarehq.org/a/billy-excerpt/api/v0.5/case/?case_type={caseType}&limit=40';

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
     * @param $caseType
     * @return mixed
     */
    public function data($caseType)
    {
        $url = str_replace('{caseType}', $caseType, $this->url);

        $response = $this->client->get($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "ApiKEY " . config('irc.commcare_api_key')
            ]
        ]);

        $responseContents = $response->getBody()->getContents();

        $responseContents = json_decode($responseContents, true);

        return $responseContents['objects'];
    }
}

