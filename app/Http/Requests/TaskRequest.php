<?php

namespace App\Http\Requests;

use App\Enums\TaskStatusEnum;
use App\Rules\AssignedUserBelongsToTeam;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => [
                'nullable',
                'integer',
                Rule::in(array_column(TaskStatusEnum::cases(), 'value'))
            ],
            'assigned_user_id' => [
                'nullable',
                'exists:users,id',
                'prohibited_if:team_id,null',
                new AssignedUserBelongsToTeam(request()->get('team_id')),
            ],
            'team_id' => 'nullable|exists:teams,id',
            'due_date' => 'nullable|date',
        ];
    }
}
