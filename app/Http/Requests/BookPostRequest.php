<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookPostRequest extends FormRequest
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
            "name" => "required",
            "author_id" => "required|numeric",
            "status" => "required",
            "book_no" => "required|numeric",
            'image' => 'mimes:png,jpeg,jpg,png',
        ];
    }


    public function messages()
    {
        return [
            "name.required" => "Bu alan zorunludur.",
            "author_id.required" => "Bu alan zorunludur.",
            "book_no.required" => "Bu alan zorunludur.",
            "status.required" => "Bu alan zorunludur.",
        ];
    }
}
