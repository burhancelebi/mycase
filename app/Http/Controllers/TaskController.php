<?php

namespace App\Http\Controllers;

use App\DTO\Tasks\TaskDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\Tasks\TaskServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ApiResponse;
    protected TaskServiceInterface $taskService;

    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $tasks = $this->taskService->getAllTasks();
        $resource = TaskResource::collection($tasks);

        return $this->successResponse($resource);
    }

    /**
     * @param TaskRequest $request
     * @return JsonResponse
     */
    public function store(TaskRequest $request): JsonResponse
    {
        $teamDto = TaskDTO::from($request);
        $task = $this->taskService->create($teamDto);
        $resource = new TaskResource($task);

        return $this->successResponse($resource);
    }

    /**
     * @param Request $request
     * @param int $teamId
     * @return JsonResponse
     */
    public function addMember(Request $request, int $teamId): JsonResponse
    {
        $team = $this->teamService->addMember($teamId, $request->get('user_id'));
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
        $team = $this->teamService->removeMember($teamId, $userId);
        $resource = new TeamResource($team);

        return $this->successResponse($resource);
    }
}
