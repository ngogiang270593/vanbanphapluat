<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**s
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'=>'required',
			'email'=>'required|email|unique:users,email',
			'password'=>'required'
		];
	}
	public function messages (){
		return [
		'name.required' => 'Vui lòng nhập họ tên',
		'email.required' => 'Vui lòng nhập email',
		'email.email' => 'Đây không phải email',
		'email.unique' => 'Email đã tồn tại',
		'password.required' => 'Vui lòng nhập mật khẩu',
		];
	}

}
