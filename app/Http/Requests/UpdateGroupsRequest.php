<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|integer',
            'assistant_id' => 'required|integer',
            'lessontime' => 'required|string',
            'days' => 'required|string',
            'level' => 'required|string',
            'id' => 'required|integer',
        ];
    }
}
