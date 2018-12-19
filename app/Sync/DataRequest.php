<?php namespace App\Sync;

use GuzzleHttp\Client;

class DataRequest
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $url = 'https://www.commcarehq.org/a/billy-excerpt/api/v0.5/case/';

    protected $whiteListParams = [
        'type',
        'limit',
        'offset',
        'page'
    ];

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
     * @param array $params
     * @return mixed
     */
    public function data($caseType, array $params = [])
    {
        $params['type'] = $caseType;

        $url = $this->url . '?' . $this->buildParamsHttpQuery($params);

        $this->client= new Client(['verify' => false]);

        $response = $this->client->get($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "ApiKEY " . config('irc.commcare_api_key')
            ]
        ]);

        $responseContents = $response->getBody()->getContents();

        $responseContents = json_decode($responseContents, true);

        return $responseContents;
    }

    protected function buildParamsHttpQuery($params)
    {
        $params['limit'] = array_get($params, 'limit') ?? 4;

        $params['page'] = array_get($params, 'page') ?? 1;
        $page = $params['page'];
        unset($params['page']);

        $params['offset'] = array_get($params, 'offset') ?? ($page - 1) * $params['limit'];

        return http_build_query($params);
    }
}

