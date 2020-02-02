<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreAttributeRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'product_id' => [
                'required',
                'exists:products,id',
                Rule::unique('attributes', 'product_id')->where('warehouse_id', $request->warehouse_id)
            ],
            'warehouse_id' => [
                'required',
                'exists:warehouses,id',
                Rule::unique('attributes', 'warehouse_id')->where('product_id', $request->product_id)
            ],
            'wholesale_price' => ['required', 'numeric'],
            'retail_price' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric']
        ];
    }
}
