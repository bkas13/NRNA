<?php

namespace App\Http\Requests\individual;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIndividualProfileRequest extends FormRequest
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
            'profileImage' => 'nullable|max:2048',
            'profileBannerImage' => 'nullable|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'profileImage.max' => 'Max upload size allowed is 2 MB',
            'profileBannerImage.max' => 'Max upload size allowed is 2 MB',
        ];
    }
}
