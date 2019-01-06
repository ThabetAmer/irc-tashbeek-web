<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class NoteResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'note' => $this->note,
            'user' => $this->user,
            'type' => $this->type,
            'created_at' => $this->created_at->toDateTimeString(),
            'created_at_text' => $this->created_at->diffForHumans(),
        ];
    }
}
