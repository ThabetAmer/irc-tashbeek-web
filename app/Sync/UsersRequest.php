<?php namespace App\Sync;

class UsersRequest extends Request
{

    /**
     * @var string
     */
    protected $url = 'https://www.commcarehq.org/a/billy-excerpt/api/v0.5/web-user/';

    /**
     * @param array $params
     * @return mixed
     */
    public function data(array $params = [])
    {
        return $this->send($params);
    }
}

