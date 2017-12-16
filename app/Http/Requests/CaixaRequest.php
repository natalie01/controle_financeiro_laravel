<?php

namespace projeto_laravel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaixaRequest extends FormRequest
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
		'valor' => 'required'
		];

    }

		public function messages()
		{
		return [
		'required' => 'O campo :attribute nao pode estar vazio.'
		];
		}
}
