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
	public function categoria() {
		return $this->belongsTo(Categoria::class);
	}
}
