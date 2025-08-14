<?php

namespace App\Repositories\Users;

use App\DTO\Auth\RegisterDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): User
    {
        return $this->user->newQuery()->findOrFail($id);
    }

    /**
     * @param string $email
     * @return User|Model
     */
    public function getUserByEmail(string $email): User|Model
    {
        return $this->user->newQuery()->where('email', $email)->firstOrFail();
    }

    /**
     * @param RegisterDTO $registerDTO
     * @return User
     */
    public function register(RegisterDTO $registerDTO): User
    {
        return $this->user->newQuery()->create([
                'name' => $registerDTO->name,
                'email' => $registerDTO->email,
                'password' => Hash::make($registerDTO->password),
            ]);
    }

    public function createAuthToken(User $user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }
}
