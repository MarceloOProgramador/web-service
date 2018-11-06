<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateProductRequest extends FormRequest
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
        (int) $id = $this->segment(3);
        return [
            "category_id" => "required|exists:categories,id",
            "name" => "required|min:3|max:50|unique:products,name,{$id},id",
            "description" => "min:15|max:1000",
            "image" => "image"
        ];
    }
}
