<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskFileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'task' => $this->whenLoaded('task', function () {
                return TaskResource::make($this->task);
            }),
            'filename' => $this->filename,
            'original_name' => $this->original_name,
            'file_path' => $this->file_path,
        ];
    }
}
