<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace App\Sync;


abstract class Request
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $url;

    /**
     * StructureRequest constructor.
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    protected function buildParamsHttpQuery($params)
    {
        $params['limit'] = array_get($params, 'limit') ?? 80;

        $params['page'] = array_get($params, 'page') ?? 1;
        $page = $params['page'];
        unset($params['page']);

        $params['offset'] = array_get($params, 'offset') ?? ($page - 1) * $params['limit'];

        return http_build_query($params);
    }

    public function send(array $params = [])
    {
        $url = $this->url . '?' . $this->buildParamsHttpQuery($params);

        $response = $this->client->get($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "ApiKEY " . config('irc.commcare_api_key')
            ]
        ]);

        $responseContents = $response->getBody()->getContents();

        return json_decode($responseContents, true);
    }
}