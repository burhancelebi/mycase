<?php

namespace App\Services\Teams;

use App\DTO\Teams\TeamDTO;
use App\Models\Team;

interface TeamServiceInterface
{
    public function getAllTeams();
    public function getTeamById(int $id): ?Team;
    public function create(TeamDTO $teamDTO): Team;
    public function update(int $id, TeamDTO $teamDTO): Team;
    public function addMember(int $teamId, int $userId): Team;
    public function removeMember(int $teamId, int $userId): Team;
    public function delete(int $id): bool;
}
