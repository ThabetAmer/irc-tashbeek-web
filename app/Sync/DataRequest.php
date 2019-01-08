<?php namespace App\Sync;

class DataRequest extends Request
{
    /**
     * @var string
     */
    protected $url = 'https://www.commcarehq.org/a/billy-excerpt/api/v0.5/case/';

    /**
     * @param $caseType
     * @param array $params
     * @return mixed
     */
    public function data($caseType, array $params = [])
    {
        $params['type'] = $caseType;

        return $this->send($params);
    }
}

