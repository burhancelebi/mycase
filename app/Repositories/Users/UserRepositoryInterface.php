<?php

namespace App\Repositories\Users;

use App\DTO\Auth\RegisterDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function getUserById(int $id): User;
    public function getUserByEmail(string $email): User|Model;

    public function register(RegisterDTO $registerDTO): User|Model;

    public function createAuthToken(User $user): string;
}
