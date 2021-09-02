<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'nome'				=> 'required|max:255',
			'tipo'				=> 'required|size:2|',
			'categoria'			=> 'required',
			'uf'				=> 'required|size:2',
			'data_nascimento'	=> 'required|date',
			'telefone'			=> 'required'
        ];
    }

	/**
	 * Configure the validator instance.
	 *
	 * @param  \Illuminate\Validation\Validator  $validator
	 * @return void
	 */
	public function withValidator($validator)
	{
		$validator->after(function ($validator) {
			// não permitir cadastrar clientes de MG como Pessoa Física
			if ($this->tipo === 'PF' && $this->uf === 'MG')
				$validator->errors()->add('tipo', 'Não é possível cadastrar o tipo Pessoa Física para clientes de Minas Gerais!');
		});
	}

	/**
	 * Get custom attributes for validator errors.
	 *
	 * @return array
	 */
	public function attributes()
	{
		return [
			'data_nascimento' => 'data de nascimento/fundação',
			'uf' => 'UF'
		];
	}

}
