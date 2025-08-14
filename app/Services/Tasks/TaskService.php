<?php

namespace App\Services\Tasks;

use App\DTO\Tasks\TaskDTO;
use App\DTO\Tasks\TaskFileDTO;
use App\Enums\TaskStatusEnum;
use App\Events\TaskAssigned;
use App\Events\TaskCompleted;
use App\Http\Requests\StoreTaskFileRequest;
use App\Models\Task;
use App\Models\User;
use App\Repositories\Tasks\TaskRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class TaskService implements TaskServiceInterface
{
    protected TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getAllTasks(): LengthAwarePaginator
    {
        return $this->taskRepository->getAllTasks();
    }

    /**
     * @param TaskDTO $taskDTO
     * @return Task
     */
    public function create(TaskDTO $taskDTO): Task
    {
        $task = $this->taskRepository->create($taskDTO);

        if (!is_null($task->assigned_user_id)) {
            event(new TaskAssigned($task));
        }

        return $task;
    }

    /**
     * @param int $taskId
     * @param TaskDTO $taskDTO
     * @return Task
     */
    public function update(int $taskId, TaskDTO $taskDTO): Task
    {
        $task = $this->taskRepository->findById($taskId);
        $updatedTask = $this->taskRepository->update($task, $taskDTO);

        if ($updatedTask->wasChanged('assigned_user_id')) {
            event(new TaskAssigned($updatedTask));
        }

        if ($task->wasChanged('status') && $task->status == TaskStatusEnum::COMPLETED->value) {

            event(new TaskCompleted($task));
        }

        return $updatedTask;
    }

    /**
     * @param int $taskId
     * @return bool
     */
    public function delete(int $taskId): bool
    {
        $task = $this->taskRepository->findById($taskId);

        return $this->taskRepository->delete($task);
    }

    /**
     * @param int $id
     * @return Task
     */
    public function findById(int $id): Task
    {
        return $this->taskRepository->findById($id);
    }

    /**
     * @param Task $task
     * @param User $user
     * @return Task
     */
    public function assignTask(Task $task, User $user): Task
    {
        return $this->taskRepository->assignTask($task, $user);
    }

    /**
     * @param StoreTaskFileRequest $request
     * @param int $taskId
     * @return Task
     */
    public function storeFiles(StoreTaskFileRequest $request, int $taskId): Task
    {
        $task = $this->taskRepository->findById($taskId);

        foreach ($request->file('files') as $file) {
            $originalName = $file->getClientOriginalName();
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('tasks', $filename);
            $taskFileDto = new TaskFileDto($filename, $originalName, $filePath);
            $this->taskRepository->storeFiles($task, $taskFileDto);
        }

        $task->load('files');

        return $task;
    }
}
