<?php namespace App\Sync;

class MobileWorkersRequest extends Request
{

    /**
     * @var string
     */
    protected $url = 'https://www.commcarehq.org/a/billy-excerpt/api/v0.5/user/';

    /**
     * @param array $params
     * @return mixed
     */
    public function data(array $params = [])
    {
        $results = $this->send($params);

        $results['objects'] = array_map(function ($object) {
            return array_merge($object, [
                'email' => $this->getEmail($object),
                'first_name' => $this->getFirstName($object)
            ]);
        }, $results['objects']);

        return $results;
    }

    protected function getEmail($object)
    {
        if(empty(array_get($object, 'email'))){
            return array_get($object, 'username');
        }
        return  $object['email'];
    }

    protected function getFirstName($object){
        if(empty(array_get($object, 'first_name')) && empty(array_get($object, 'last_name'))){
            return $this->getEmail($object);
        }
        return  $object['first_name'];
    }
}

