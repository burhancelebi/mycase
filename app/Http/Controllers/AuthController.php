<?php

namespace App\Http\Controllers;

use App\DTO\Auth\LoginDTO;
use App\DTO\Auth\RegisterDTO;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\Users\UserServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;
    protected UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $registerDTO = new RegisterDTO($request->get('name'),
            $request->get('email'),
            $request->get('password')
        );

        $user = $this->userService->register($registerDTO);
        $resource = UserResource::make($user);

        return $this->successResponse($resource);
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $loginDto = new LoginDTO($request->get('email'), $request->get('password'));
        $user = $this->userService->login($loginDto);
        $resource = UserResource::make($user);

        return $this->successResponse($resource);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function user(Request $request): JsonResponse
    {
        $resource = UserResource::make($request->user());

        return $this->successResponse($resource);
    }
}
