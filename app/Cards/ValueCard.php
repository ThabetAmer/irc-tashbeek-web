<?php namespace App\Http\Cards;

use App\Models\Firm;

/**
 * Class ValueCard
 * @package App\Http\Cards
 */
class ValueCard extends Card
{
    protected $method = 'count'; // initial value

    protected $model;

    /**
     * @return ValueCard
     */
    public function apply()
    {
        $query = $this->getQuery();

        switch ($this->method) {
            case 'count':
            default:
                return $query->count();
            case 'avg':
                return $query->avg('id');

        }
    }

    public function component()
    {
        return 'value-card';
    }


    /**
     * @param $model
     * @return $this
     */
    public function model($model)
    {
        $this->model = $model;
        return $this;
    }

    public function getQuery()
    {
        return app($this->model)->query();
    }

    /**
     * @return mixed
     */
    public function count()
    {
        $this->method = 'count';
        return $this;
    }


    /**
     * @return mixed
     */
    public function avg()
    {
        $this->method = 'avg';
        return $this;
    }


}
