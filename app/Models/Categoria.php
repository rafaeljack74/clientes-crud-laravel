<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

	/**
	 * @var array $fillable
	 */
	protected $fillable = [
		'nome', 'descricao'
	];

	/**
	 * Retorna os clientes relacionados a categoria.
	 */
	public function clientes() {
		return $this->hasMany(Cliente::class);
	}
}
