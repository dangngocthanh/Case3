<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'name' => 'min:4|required',
            'email' => 'required|email',
            'password' => 'required|min:6|max:15',
        ];
    }

    public function messages()
    {
        return [
            'name.min' => 'Tên có phải có độ dài ít nhất 8 kí tự',
            'name.required' => 'Tên người dùng không được để trống',
            'email.required' => 'Email người dùng không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => "Mật khẩu không được để trống",
            'password.min' => "Mật khẩu từ 6-15 kí tự",
            'password.max' => "Mật khẩu từ 6-15 kí tự",
        ];
    }
}
