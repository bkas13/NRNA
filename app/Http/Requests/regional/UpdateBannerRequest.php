<?php

namespace App\Http\Requests\regional;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
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
            'image' => 'nullable|mimes:png,jpg,jpeg,gif|max:2048',
            'title' => 'nullable|max:255',
            'subtitle'=>'nullable',

        ];
    }
}
