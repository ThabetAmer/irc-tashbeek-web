<?php namespace App\Sync;


class StructureRequest extends Request
{
    /**
     * @var string
     */
    protected $url = 'https://www.commcarehq.org/a/billy-excerpt/api/v0.5/application/c61e28d4cb837ae011d1d0ea2ddd2dba';

    /**
     * @return mixed
     */
    public function getModules()
    {
        return $this->send()['modules'];
    }
}

