<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductImageRequest extends FormRequest
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
        $rules = [
            'name'=> 'required|max:255',
            'description'=> 'required',
            'address'=> 'required',
            'price' => 'required',
            'category_id' => 'required',
            'images' => 'required',
            'images.' => 'image|mimes:jpeg,bmp,png|max:5120',
        ];
        return $rules;
    }
}
