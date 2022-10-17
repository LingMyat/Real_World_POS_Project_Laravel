<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PizzaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>['required',Rule::unique('products')->ignore($this->id)],
            'description'=>'required',
            'price'=>'required|min:2',
            'image'=>'mimes:png,jpg,jpeg',
            'category_id'=>'required',
            'waiting_time'=>'required'
        ];
    }


}
