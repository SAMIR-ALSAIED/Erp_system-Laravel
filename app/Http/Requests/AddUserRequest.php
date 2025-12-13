<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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

            'name'=> 'required',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|max:20',
         'roles_name' => 'required',
            'status'=>'required'

        ];



    }


    public function messages(): array
{
    return [
        'name.required' => 'اسم المستخدم مطلوب.',
        'email.required' => 'البريد الإلكتروني مطلوب.',
        'email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
        'email.unique' => 'هذا البريد الإلكتروني مستخدم بالفعل.',
        'password.required' => 'كلمة المرور مطلوبة.',
        'password.min' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل.',
        'password.max' => 'كلمة المرور لا تزيد عن 20 حرف.',
    ];
}

}
