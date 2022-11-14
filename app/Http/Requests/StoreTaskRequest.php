<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string', 'max:500'],
            'status' => ['required', 'string', Rule::in(Task::getStatuses())],
            'tags' => ['nullable', 'array'],
            'tags.*.id' => ['exists:tags,id'],
        ];
    }
}
