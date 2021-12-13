<?php

namespace App\Http\Requests\regional;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRegionalRequest extends FormRequest
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
        $id = $this->input('user_id');
        return [
            'email' => 'required|email|min:6|max:255|unique:users,email,' . $id,
            'username' => 'required|min:6|max:20|unique:users,username,' . $id,
            'name' => 'required|min:6|max:255',
            'password' => 'confirmed|max:255',
        ];
    }
}
