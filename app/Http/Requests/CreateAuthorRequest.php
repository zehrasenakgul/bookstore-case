<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAuthorRequest extends FormRequest
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
            'name' => 'required|max:255',
            'status' => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bu alan zorunludur.',
            'status.required' => 'Bu alan zorunludur.',
        ];
    }
}
