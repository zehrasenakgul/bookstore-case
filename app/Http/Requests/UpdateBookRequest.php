<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest {
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
            'author_id' => 'required',
            'book_no' => 'required',
            'status' => 'required|boolean',
            'image' => 'mimes:png,jpeg,jpg,PNG,JPG,JPEG|max:255',
        ];
    }

    public function messages() {
        return [
            'author_id.required' => 'Bu alan zorunludur.',
            'book_no.required' => 'Bu alan zorunludur.',
            'status.required' => 'Bu alan zorunludur.',
            'image.mimes' => 'Resim jpg,png veya jpeg olmalıdır.',
        ];
    }
}
