<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SigninRequest extends FormRequest
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
            'name' => 'required|alpha',
            'lastname' => 'required|alpha',
            'email' => 'required|required|between:8,30',
            'password' => 'required',
            'password_verif' => 'required|same:password',
            'cgu' => 'required',
        ];
    }
}
