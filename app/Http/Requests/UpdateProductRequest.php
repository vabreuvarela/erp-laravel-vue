<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        #TODO
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
            'name' => [
                'required',
                'unique:products',
                Rule::unique('products', 'name')->ignore($this->product->id)
            ],
            'sku' => [
                'required',
                'unique:products',
                Rule::unique('products', 'sku')->ignore($this->product->id)
            ],
            'upc' => [
                'required',
                'unique:products',
                Rule::unique('products', 'upc')->ignore($this->product->id)
            ],
            'cost' => ['required']
        ];
    }
}
