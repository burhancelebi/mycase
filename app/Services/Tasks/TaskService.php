<?php

namespace App\Services\Tasks;

use App\DTO\Tasks\TaskDTO;
use App\Models\Task;
use App\Models\User;
use App\Repositories\Tasks\TaskRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

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
        return $this->taskRepository->create($taskDTO);
    }

    /**
     * @param Task $task
     * @param TaskDTO $taskDTO
     * @return Task
     */
    public function update(Task $task, TaskDTO $taskDTO): Task
    {
        return $this->taskRepository->update($task, $taskDTO);
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function delete(Task $task): bool
    {
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

    public function addFileToTask()
    {
        // TODO: Implement addFileToTask() method.
    }
}
