<?php

namespace Database\Seeders;

use App\Models\Categoria;

use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listaCategorias = [
			'Diamante', 'Ouro', 'Prata', 'Bronze'
		];

		foreach ($listaCategorias as $categoria) {
			Categoria::create([
				'nome' => $categoria
			]);
		}
    }
}
