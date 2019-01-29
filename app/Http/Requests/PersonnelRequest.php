<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonnelRequest extends FormRequest
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
            'new_password' => 'required_with:old_password,verif_password,email|same:verif_password',
            'verif_password' => 'required_with:old_password,new_password,email|same:new_password',
            'old_password' => 'required_with:verif_password,new_password,email',
            'email' => 'required_with:verif_password,new_password,old_password',
        ];
    }
}
