<?php

namespace App\Http\Requests\Diary\Task;

use App\Enums\Tasks\TaskStatusEnum;
use App\Enums\Tasks\TaskTypesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['uuid', 'required'],
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'user_id' => ['integer', 'exists:users,id'],
            'status' => [Rule::enum(TaskStatusEnum::class)],
            'type' => [Rule::enum(TaskTypesEnum::class)],
            'status_change_date' => ['date', 'nullable'],
            'due_date' => ['date', 'nullable'],
            'start_time' => ['date', 'nullable'],
            'stop_time' => ['date', 'nullable'],
        ];
    }
}
