<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Input;

class ProjectRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'        => 'required',
			'jira_key'    => 'required',
			'start_date'  => 'required|date|date_format:Y-m-d',
			'end_date'    => 'required|date|date_format:Y-m-d',
		];
	}
}
