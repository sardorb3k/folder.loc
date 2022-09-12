<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentsRequest extends FormRequest
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|unique:users,phone',
            'birthday' => 'required|date',
            'gender' => 'required',
            'homeaddress' => 'required',
            'reasontostudy' => 'required',
            'interests' => 'required',
            'hear_about' => 'required',
            'course' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
