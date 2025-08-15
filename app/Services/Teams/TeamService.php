<?php

namespace App\Services\Teams;

use App\DTO\Teams\TeamDTO;
use App\Models\Team;
use App\Repositories\Teams\TeamRepositoryInterface;
use App\Services\Users\UserServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class TeamService implements TeamServiceInterface
{
    protected TeamRepositoryInterface $teamRepository;
    protected UserServiceInterface $userService;

    public function __construct(TeamRepositoryInterface $teamRepository, UserServiceInterface $userService)
    {
        $this->teamRepository = $teamRepository;
        $this->userService = $userService;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getAllTeams(): LengthAwarePaginator
    {
        return $this->teamRepository->all();
    }

    /**
     * @param int $id
     * @return Team|null
     */
    public function getTeamById(int $id): ?Team
    {
        return $this->teamRepository->find($id);
    }

    /**
     * @param TeamDTO $teamDTO
     * @return Team
     */
    public function create(TeamDTO $teamDTO): Team
    {
        return $this->teamRepository->create($teamDTO);
    }

    /**
     * @param int $id
     * @param TeamDTO $teamDTO
     * @return Team
     */
    public function update(int $id, TeamDTO $teamDTO): Team
    {
        $team = $this->teamRepository->find($id);

        return $this->teamRepository->update($team, $teamDTO);
    }

    /**
     * @param Team $team
     * @param int $userId
     * @return Team
     */
    public function addMember(Team $team, int $userId): Team
    {
        $team = $this->teamRepository->find($team->id);
        $user = $this->userService->getUserById($userId);
        $team->members()->attach($user);

        return $team;
    }

    /**
     * @param Team $team
     * @param int $userId
     * @return Team
     */
    public function removeMember(Team $team, int $userId): Team
    {
        $team->members()->detach($userId);

        return $team;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->teamRepository->delete($id);
    }
}
