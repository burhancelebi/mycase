<?php

namespace App\Http\Controllers;

use App\DTO\Tasks\TaskDTO;
use App\Http\Requests\StoreTaskFileRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\Tasks\TaskServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

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
        $taskDto = TaskDTO::from($request->all());
        $taskDto->created_by = $request->user()->id;
        $task = $this->taskService->create($taskDto);
        $task->load('createdBy', 'team', 'assignedUser');
        $resource = new TaskResource($task);

        return $this->successResponse($resource);
    }

    /**
     * @param TaskRequest $request
     * @param int $taskId
     * @return JsonResponse
     */
    public function update(TaskRequest $request, int $taskId): JsonResponse
    {
        $taskDto = TaskDTO::from($request->all());
        $taskDto->created_by = $request->user()->id;
        $task = $this->taskService->update($taskId, $taskDto);
        $task->load('createdBy', 'team', 'assignedUser');
        $resource = new TaskResource($task);

        return $this->successResponse($resource);
    }

    /**
     * @param int $teamId
     * @return JsonResponse
     */
    public function destroy(int $teamId): JsonResponse
    {
        $this->taskService->delete($teamId);

        return $this->successResponse();
    }

    /**
     * @param StoreTaskFileRequest $request
     * @param int $taskId
     * @return JsonResponse
     */
    public function storeFile(StoreTaskFileRequest $request, int $taskId): JsonResponse
    {
        $task = $this->taskService->storeFiles($request, $taskId);
        $resource = TaskResource::make($task);

        return $this->successResponse($resource);
    }
}
