<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'price' => 'required',
            'deposittime' => 'required',
            'ngaysinh' => 'required',
            'sdt' => 'required|max:10',
            'email' => 'required|email:rfc'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập tên phòng',
            'price.required' => 'Chưa nhập giá',
            'deposittime.required' => 'Chưa chọn ngày hạn tiền hằng tháng',
            'ngaysinh.required' => 'Chưa nhập ngày sinh',
            'sdt.required' => 'Chưa nhập số điện thoại',
            'sdt.max' => 'Số điện thoại không được quá 10 chữ số',
            'email.required' => 'Chưa nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng mail'
        ];
    }
}
