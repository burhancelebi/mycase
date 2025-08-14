<?php

namespace App\Repositories\Teams;

use App\DTO\Teams\TeamDTO;
use App\Models\Team;
use Illuminate\Pagination\LengthAwarePaginator;

class TeamRepository implements TeamRepositoryInterface
{
    /**
     * @var Team
     */
    protected Team $team;

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        return $this->team->newQuery()->paginate(request()->input('per_page', 21));
    }

    /**
     * @param int $id
     * @return Team|null
     */
    public function find(int $id): ?Team
    {
        return $this->team->newQuery()->find($id);
    }

    /**
     * @param TeamDTO $teamDTO
     * @return Team
     */
    public function create(TeamDTO $teamDTO): Team
    {
        return $this->team->newQuery()->create([
            'name' => $teamDTO->name,
            'description' => $teamDTO->description,
            'owner_id' => $teamDTO->owner_id,
        ]);
    }

    /**
     * @param Team $team
     * @param TeamDTO $teamDTO
     * @return Team
     */
    public function update(Team $team, TeamDTO $teamDTO): Team
    {
        $team->name = $teamDTO->name;
        $team->description = $teamDTO->description;
        $team->owner_id = $teamDTO->owner_id;
        $team->save();

        return $team;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->team->newQuery()->find($id)->delete();
    }
}
