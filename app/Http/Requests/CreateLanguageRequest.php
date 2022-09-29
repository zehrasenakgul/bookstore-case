<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLanguageRequest extends FormRequest {
    /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */

    public function authorize() {
        return true;
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */

    public function rules() {
        return [
            'name' => 'required|max:255',
            'code' => 'required',
            'icon' => 'mimes:png,jpeg,jpg,PNG,JPG,JPEG|max:255',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Bu alan zorunludur.',
            'code.required' => 'Bu alan zorunludur.',
            'icon.mimes' => 'Resim jpg,png veya jpeg olmalıdır.',
        ];
    }
}
