<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      try {
        $data = [
          'title' => $this->story_data['title'],
          'text' => $this->story_data['text'],
          'ssml' => $this->story_data['ssml']
        ];
        return $data;
      } catch ($e) {
        return parent::toArray($request);
      }

    }
}
