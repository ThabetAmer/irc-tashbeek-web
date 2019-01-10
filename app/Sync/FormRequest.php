<?php namespace App\Sync;

class FormRequest extends Request
{
    /**
     * @var string
     */
    protected $url = 'https://www.commcarehq.org/a/billy-excerpt/api/v0.5/form';

    /**
     * Perform request and fetch data
     *
     * @param array $params
     * @return mixed
     */
    public function data(array $params = [])
    {
        return $this->send($params);
    }
}

