<?php

namespace App\Services\Tasks;

use App\DTO\Tasks\TaskDTO;
use App\Http\Requests\StoreTaskFileRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface TaskServiceInterface
{
    public function getAllTasks(): LengthAwarePaginator;
    public function create(TaskDTO $taskDTO): Task;
    public function update(int $taskId, TaskDTO $taskDTO): Task;
    public function delete(int $taskId): bool;
    public function findById(int $id): Task;
    public function assignTask(Task $task, User $user): Task;

    public function storeFiles(StoreTaskFileRequest $request, int $taskId);
}
