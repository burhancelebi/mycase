<?php

namespace App\Repositories\Tasks;

use App\DTO\Tasks\TaskDTO;
use App\Models\Task;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @var Task
     */
    protected Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getAllTasks(): LengthAwarePaginator
    {
        return $this->task->newQuery()->paginate(21);
    }

    /**
     * @param TaskDTO $taskDTO
     * @return Task
     */
    public function create(TaskDTO $taskDTO): Task
    {
        return $this->task->newQuery()->create($taskDTO->toArray());
    }

    /**
     * @param Task $task
     * @param TaskDTO $taskDTO
     * @return Task
     */
    public function update(Task $task, TaskDTO $taskDTO): Task
    {
        $task->fill($taskDTO->toArray())->save();

        return $task;
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function delete(Task $task): bool
    {
        return $task->delete();
    }

    /**
     * @param int $id
     * @return Task
     */
    public function findById(int $id): Task
    {
        return $this->task->newQuery()->findOrFail($id);
    }

    /**
     * @param Task $task
     * @param User $user
     * @return Task
     */
    public function assignTask(Task $task, User $user): Task
    {
        $task->assigned_user_id = $user->id;
        $task->save();

        return $task;
    }

    public function addFileToTask()
    {
        // TODO: Implement addFileToTask() method.
    }
}
