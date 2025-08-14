<?php

namespace App\Repositories\Teams;

use App\DTO\Teams\TeamDTO;
use App\Models\Team;
use Illuminate\Pagination\LengthAwarePaginator;

interface TeamRepositoryInterface
{
    public function all(): LengthAwarePaginator;
    public function find(int $id): ?Team;
    public function create(TeamDTO $teamDTO): Team;
    public function update(Team $team, TeamDTO $teamDTO): Team;
    public function delete(int $id): bool;
}
