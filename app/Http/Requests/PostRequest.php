<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'image' => 'required|mimes:png,jpg,svg,jpeg|max:2000',
            'title' => 'required|min:3',
            'body' => 'required',
            'tags' => 'required|array',
            'category' => 'required'
        ];
    }
}
