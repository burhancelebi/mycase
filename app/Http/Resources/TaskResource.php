<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'assigned_user' => $this->whenLoaded('assignedUser', function () {
                return UserResource::make($this->assignedUser);
            }),
            'due_date' => $this->due_date,
            'team' => $this->whenLoaded('team', function () {
                return TeamResource::make($this->team);
            }),
            'created_by' => $this->whenLoaded('createdBy', function () {
                return UserResource::make($this->createdBy);
            }),
            'files' => $this->whenLoaded('files', function () {
                return TaskFileResource::collection($this->files);
            })
        ];
    }
}
