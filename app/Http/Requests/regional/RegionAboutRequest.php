<?php

namespace App\Http\Requests\regional;

use Illuminate\Foundation\Http\FormRequest;

class RegionAboutRequest extends FormRequest
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
            'region_logo'=>'nullable|mimes:png,jpg,jpeg,gif|max:2048',
            'about_image'=>'nullable|mimes:png,jpg,jpeg,gif|max:2048',
            'feature_image'=>'nullable|mimes:png,jpg,jpeg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'region_logo.max'=>'Image size cannot be greater than 2MB',
            'about_image.max'=>'Image size cannot be greater than 2MB',
            'feature_image.max'=>'Image size cannot be greater than 2MB',
        ];
    }
}
