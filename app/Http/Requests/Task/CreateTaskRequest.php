<?php

namespace App\Http\Requests\Task;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();
        if($user){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id'=>'required',
            'title'=>'required|string|min:4|max:255|unique:tasks,title',
            'description'=>'nullable|string',
            'due_date'=>'required|date',
            'status'=>'required|in:pending,completed'
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        // return redirect()->back()->with('errors',$validator->errors());
        return redirect()->back()->withErrors($validator->errors());
    }
    public function attributes(){
       return [
            'title'=>'task title',
            'description'=>'description',
            'due_date'=>'due Date',
            'status'=>'task status'
        ];
    }
    public function messages(){
        return [
            'required'=>'Error : The :attribute field is required',
            'string'=>'Error : The :attribute value must be a string',
            'unique'=>'Error : The :attribute value must be a unique',
            'min'=>'Error : The :attribute min character is :min',
            'max'=>'Error : The :attribute max character is :max',
            'in'=>'Error : The :attribute field value is invalid'
        ];
    }
}
