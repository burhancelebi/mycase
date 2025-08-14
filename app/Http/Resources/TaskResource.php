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
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'assigned_user_id' => $this->assigned_user_id,
            'due_date' => $this->due_date?->format('Y-m-d'),
            'team_id' => $this->team_id,
            'created_by' => $this->created_by,
        ];
    }
}
