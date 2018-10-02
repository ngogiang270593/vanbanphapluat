<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddUser extends Request {

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
			'txtUser'=>'required',
			'txtEmail'=>'required|email|unique:users,email',
			'txtPass'=>'required'
		];
	}
	public function messages (){
		return [
		'txtUser.required' => 'Vui lòng nhập họ tên',
		'txtEmail.required' => 'Vui lòng nhập email',
		'txtEmail.email' => 'Đây không phải email',
		//'email.unique' => 'Email đã tồn tại',
		'txtPass.required' => 'Vui lòng nhập mật khẩu',
		];
	}


}
