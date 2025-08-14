<?php

namespace App\Services\Users;

use App\DTO\Auth\LoginDTO;
use App\DTO\Auth\RegisterDTO;
use App\Exceptions\AuthFailedException;
use App\Models\User;
use App\Repositories\Users\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): User
    {
        return $this->userRepository->getUserById($id);
    }

    /**
     * @throws AuthFailedException
     */
    public function login(LoginDTO $loginDTO): User
    {
        $user = $this->userRepository->getUserByEmail($loginDTO->email);

        if (!Hash::check($loginDTO->password, $user->password)) {
            throw new AuthFailedException('Email veya şifre hatalı.');
        }

        $token = $this->userRepository->createAuthToken($user);
        $user->setAttribute('auth_token', $token);

        return $user;
    }

    /**
     * @param RegisterDTO $registerDTO
     * @return User
     * @throws AuthFailedException
     */
    public function register(RegisterDTO $registerDTO): User
    {
        try {
            $user = $this->userRepository->register($registerDTO);
            $token = $this->userRepository->createAuthToken($user);
            $user->setAttribute('auth_token', $token);

            return $user;
        } catch (Exception $exception) {
            throw new AuthFailedException($exception->getMessage());
        }
    }
}
