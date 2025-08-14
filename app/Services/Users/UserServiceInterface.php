<?php

namespace App\Services\Users;

use App\DTO\Auth\LoginDTO;
use App\DTO\Auth\RegisterDTO;
use App\Models\User;

interface UserServiceInterface
{
    public function getUserById(int $id): User;
    public function login(LoginDTO $loginDTO): User;
    public function register(RegisterDTO $registerDTO): User;
}
