<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'headers' => [
                [
                    'label' => 'Name',
                    'name' => 'name'
                ],
                [
                    'label' => 'Email',
                    'name' => 'email'
                ],
                [
                    'label' => 'Created At',
                    'name' => 'created_at'
                ]
            ],
            'filters' => [
                [
                    'label' => 'Name',
                    'name' => 'name',
                    'options' => [],
                    'type' => 'text'
                ],
                [
                    'label' => 'Email',
                    'name' => 'email',
                    'options' => [],
                    'type' => 'text'
                ],
                [
                    'label' => 'Created At',
                    'name' => 'created_at',
                    'options' => [],
                    'type' => 'text',
                ],
            ],
        ];
    }


}
