<?php

namespace App\DTO\Teams;

class TeamDTO
{
    public function __construct(
        public string $name,
        public ?string $description,
        public int $owner_id,
    ) {
    }
}
