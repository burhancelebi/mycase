<?php

namespace App\Repositories\Tasks;

use App\DTO\Tasks\TaskDTO;
use App\Models\Task;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface TaskRepositoryInterface
{
    public function getAllTasks(): LengthAwarePaginator;
    public function create(TaskDTO $taskDTO): Task;
    public function update(Task $task, TaskDTO $taskDTO): Task;
    public function delete(Task $task): bool;
    public function findById(int $id): Task;
    public function assignTask(Task $task, User $user): Task;

    public function addFileToTask();
}
