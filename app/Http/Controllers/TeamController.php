<?php

namespace App\Http\Controllers;

use App\DTO\Teams\TeamDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Http\Resources\TeamResource;
use App\Services\Teams\TeamServiceInterface;
use App\Services\Users\UserServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TeamController extends Controller
{
    use ApiResponse;
    protected TeamServiceInterface $teamService;

    public function __construct(TeamServiceInterface $teamService)
    {
        $this->teamService = $teamService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $teams = $this->teamService->getAllTeams();
        $resource = TeamResource::collection($teams);

        return $this->successResponse($resource);
    }

    /**
     * @param TeamRequest $request
     * @return JsonResponse
     */
    public function store(TeamRequest $request): JsonResponse
    {
        $teamDto = new TeamDTO(
            $request->get('name'),
            $request->get('description'),
            $request->get('owner_id')
        );

        $team = $this->teamService->create($teamDto);
        $resource = new TeamResource($team);

        return $this->successResponse($resource);
    }

    /**
     * @param Request $request
     * @param int $teamId
     * @return JsonResponse
     */
    public function addMember(Request $request, int $teamId): JsonResponse
    {
        $team = $this->teamService->getTeamById($teamId);
        Gate::authorize('addMember', $team);
        $this->teamService->addMember($team, $request->get('user_id'));
        $resource = new TeamResource($team);

        return $this->successResponse($resource);
    }

    /**
     * @param int $teamId
     * @param int $userId
     * @return JsonResponse
     */
    public function removeMember(int $teamId, int $userId): JsonResponse
    {
        $team = $this->teamService->getTeamById($teamId);
        Gate::authorize('removeMember', $team);
        $this->teamService->removeMember($team, $userId);
        $resource = new TeamResource($team);

        return $this->successResponse($resource);
    }
}
