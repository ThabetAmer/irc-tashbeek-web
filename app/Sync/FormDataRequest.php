<?php namespace App\Sync;

class FormDataRequest
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $url = 'https://www.commcarehq.org/a/billy-excerpt/api/v0.5/form';

    /**
     * StructureRequest constructor.
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    /**
     * Perform request and fetch data
     *
     * @param array $params
     * @return mixed
     */
    public function data(array $params = [])
    {
        $url = $this->url . '?' . $this->buildParamsHttpQuery($params);

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

    /**
     * Build queryString from array
     *
     * @param $params
     * @return string
     */
    protected function buildParamsHttpQuery($params)
    {
        $params['limit'] = array_get($params, 'limit') ?? 40;

        $params['page'] = array_get($params, 'page') ?? 1;
        $page = $params['page'];
        unset($params['page']);

        $params['offset'] = array_get($params, 'offset') ?? ($page - 1) * $params['limit'];

        return http_build_query($params);
    }
}

