<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AccountInfoUpdatedRequest extends FormRequest
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
            'name'=>'required',
            'email'=>['required',Rule::unique('users')->ignore($this->id)],
            'phone'=>'required',
            'address'=>'required',
            'role'=>'',
            'gender'=>'',
            'image'=>'mimes:png,jpg,jpeg',
        ];
    }
}
