<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request)
    {

        $headers = $this->headers();
        $filters = $this->filters();

        return [
            'headers' => $headers,
            'filters' => $filters,
            'sorting' => $this->getSorting($request, $headers),
        ];
    }


    protected function getSorting($request, $headers)
    {

        $headers = collect($headers)->keyBy('name');

        $sorting = $request->input('sorting', []);

        if (!is_array($sorting) || !$headers->has($request->input('sorting.column'))) {
            $sorting = [];
        }

        return [
            'column' => array_get($sorting, 'column'),
            'type' => array_get($sorting, 'type') === 'asc' ? 'asc' : 'desc',
        ];
    }

    protected function headers()
    {
        return [
            [
                'label' => trans('irc.name'),
                'name' => 'name'
            ],
            [
                'label' => trans('irc.email'),
                'name' => 'email'
            ],
            [
                'label' => trans('irc.created_at'),
                'name' => 'created_at'
            ]
        ];
    }

    protected function filters()
    {
        return [
            [
                'label' =>  trans('irc.name'),
                'name' => 'name',
                'options' => [],
                'type' => 'text'
            ],
            [
                'label' =>  trans('irc.email'),
                'name' => 'email',
                'options' => [],
                'type' => 'text'
            ],
        ];
    }
}
