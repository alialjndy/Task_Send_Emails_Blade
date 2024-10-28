<?php

namespace App\Http\Requests\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|min:5|max:100|unique:users,name',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|max:255'
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        return redirect()->back()->with('errors',$validator->errors());
    }
    public function attributes(){
       return [
            'name'=>'user name',
            'email'=> 'user email',
            'password'=>'user password'
        ];
    }
    public function messages(){
        return [
            'required'=>'Error : The :attribute field is required',
            'string'=>'Error : The :attribute field value must be a string',
            'min'=>'Error : The min character of field :attribute is :min',
            'max'=>'Error : The max character of field :attribute is :max',
            'unique'=>'Error : The :attribute is required',
            'email'=>'Error : Please Enter a valid email'
        ];
    }
}
