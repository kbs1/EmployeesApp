<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
			'name' => 'required',
			'surname' => 'required',
			'position' => 'required',
			'age' => 'required|integer|min:0',
			'gender' => 'required|in:male,female',
			'employed_at' => 'required|date:d.m.Y',
			'hourly_rate' => 'required|numeric|min:0',
		];
	}
}
