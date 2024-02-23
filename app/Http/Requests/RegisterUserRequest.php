<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

use function Laravel\Prompts\password;

class RegisterUserRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'account_type' => ['required', 'in:company,candidate'],
            'password' => ['required', 'confirmed', 'min:6'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên!',
            'name.string' => 'Tên phải ở dạng chuỗi',
            'name.max' => 'Tên tối đa 255 kí tự',
            'email.required' => 'Bạn chưa nhập Email!',
            'email.string' => 'Email phải ở dạng kí tự',
            'email.lowercase' => 'Email không chưa kí tự hoa',
            'email.email' => 'Email sai định dạng',
            'email.max' => 'Email tối đa 255 kí tự',
            'email.unique' => 'Email đã tồn tại',
            'account_type.required' => 'Bạn chưa chọn loại tài khoản!',
            'account_type.in' => 'Loại tài khoản phải thuộc !',
            'password.required' => 'Bạn chưa nhập mật khẩu!',
            'password.min' => 'Mật khẩu nhiều hơn 6 kí tự',
        ];
    }


}
