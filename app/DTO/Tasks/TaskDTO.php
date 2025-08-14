<?php

namespace App\DTO\Tasks;

use App\Enums\TaskStatusEnum;
use Spatie\LaravelData\Data;

class TaskDTO extends Data
{
    public function __construct(
        public string $title,
        public ?string $description = null,
        public ?string $status = TaskStatusEnum::PENDING->value,
        public ?int $assigned_user_id = null,
        public $due_date = null,
        public ?int $team_id = null,
        public ?int $created_by = null,
    ) {
    }
}
