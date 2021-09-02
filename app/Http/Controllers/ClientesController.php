<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\ClienteRequest;

use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
			'clientes' => Cliente::all()
		], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClienteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
		Cliente::create([
			'nome'				=> $request->input('nome'),
			'tipo'				=> $request->input('tipo'),
			'uf'				=> $request->input('uf'),
			'telefone'			=> $request->input('telefone'),
			'categoria_id'		=> $request->input('categoria'),
			'data_nascimento'	=> $request->input('data_nascimento')
		]);

		return response([
			'success' => 'Cliente cadastrado com sucesso!'
		], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);

		return response([
			'cliente' => $cliente
		], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClienteRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request, $id)
    {
		$cliente = Cliente::findOrFail($id);

		$cliente->update([
			'nome'				=> $request->input('nome'),
			'tipo'				=> $request->input('tipo'),
			'uf'				=> $request->input('uf'),
			'telefone'			=> $request->input('telefone'),
			'categoria_id'		=> $request->input('categoria'),
			'data_nascimento'	=> $request->input('data_nascimento')
		]);

        return response([
			'success' => 'Cliente atualizado com sucesso!'
		], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);

		$cliente->delete();

		return response([
			'success' => 'Cliente excluído com sucesso!'
		], 200);
    }
}
