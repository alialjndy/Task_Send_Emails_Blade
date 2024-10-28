<?php

namespace App\Http\Requests\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'=>'required|email',
            'password'=>'required'
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        return redirect()->back()->with('errors',$validator->errors());
    }
    public function attributes(){
       return [
            'email'=>'user email',
            'password'=>'User password'
        ];
    }
    public function messages(){
        return [
            'required'=>'Error : The :attribute field is required',
            'email'=>'Error : Please enter a valid email'
        ];
    }
}
