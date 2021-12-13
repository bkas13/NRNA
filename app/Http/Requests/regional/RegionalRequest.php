<?php

namespace App\Http\Requests\regional;

use Illuminate\Foundation\Http\FormRequest;

class RegionalRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'email' => 'required|email|min:6|max:255|unique:users,email',
            'username' => 'required|min:6|max:20|unique:users,username',
            'name' => 'required|min:6|max:255',
            'password' => 'required|confirmed|min:6|max:255',
        ];
    }
}
