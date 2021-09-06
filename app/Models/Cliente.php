<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

	/**
	 * @var array $fillable
	 */
	protected $fillable = [
		'nome', 'tipo', 'uf', 'data_nascimento', 'telefone', 'categoria_id'
	];

	/**
	 * Retorna a categoria relacionada ao cliente.
	 */
	public function categoria()
	{
		return $this->belongsTo(Categoria::class);
	}

	/**
	 * Retorna todos os registros com base no filtro.
	 * 
	 * @param	array|null	$filtro
	 * @return	array
	 */
	public static function getList(array $filtro = null)
	{
		$where = [];

		if (!is_null($filtro)) {
			if (!is_null($filtro['nome']))
				$where[] = ['clientes.nome', 'like', '%' . $filtro['nome'] . '%'];

			if (!is_null($filtro['uf']))
				$where[] = ['clientes.uf', '=', $filtro['uf']];

			if (!is_null($filtro['categoria']))
				$where[] = ['clientes.categoria_id', '=', $filtro['categoria']];
		}

		$clientes = Cliente::where($where)
			->with(['categoria'])
			->orderBy('clientes.nome')
			->paginate(10);

		return $clientes;
	}
}
