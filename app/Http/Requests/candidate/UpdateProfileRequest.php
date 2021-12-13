<?php

namespace App\Http\Requests\candidate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'email'=>'email',
            'candidate_image'=>'max:2048|mimes:png,jpg,jpeg',
            'candidate_banner'=>'max:2048|mimes:png,jpg,jpeg',
        ];
    }

    public function messages()
    {
        return [
            'candidate_image.max' => 'Image size cannot be greater than 2MB',
            'candidate_banner.max' => 'Image size cannot be greater than 2MB',        ];
    }
}
