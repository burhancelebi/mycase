<?php

namespace App\DTO\Tasks;

use Spatie\LaravelData\Data;

class TaskFileDTO extends Data
{
    public function __construct(
        public string $filename,
        public string $originalName,
        public string $filePath
    ) {
    }
}
