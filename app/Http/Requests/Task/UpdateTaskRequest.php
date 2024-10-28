<?php

namespace App\Http\Requests\Task;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTaskRequest extends FormRequest
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
            'user_id'=>'nullable',
            'title'=>'nullable|string|min:4|max:255|unique:tasks,title',
            'description'=>'nullable|string',
            'due_date'=>'nullable|date',
            'status'=>'nullable|in:pending,completed'
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
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
            'string'=>'Error : The :attribute value must be a string',
            'unique'=>'Error : The :attribute value must be a unique',
            'min'=>'Error : The :attribute min character in :min',
            'max'=>'Error : The :attribute max character in :max',
            'in'=>'Error : The :attribute field value is invalid'
        ];
    }
}
