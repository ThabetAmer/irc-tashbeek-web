<?php namespace App\Http\Cards;

use Illuminate\Http\Request;
use App\Models\PropertyMetaData;
use Illuminate\Database\Eloquent\Builder;

abstract class Card
{
    protected $name;

    protected $label;

    abstract public function apply();

    abstract public function component();

    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'label' => $this->getLabel(),
            'value' => $this->apply(),
            'component' => $this->component(),
        ];
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;
    }


    public function getLabel()
    {
        return $this->label;
    }


    public function label($label)
    {
        $this->label = $label;

        $this->setName($label);

        return $this;
    }

    /**
     * @param $label
     * @return self
     */
    public static function make($label) : self
    {
        $object = app(static::class);

        $object->label($label);

        return $object;
    }



}