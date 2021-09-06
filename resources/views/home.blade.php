@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>Cadastro de Clientes</h1>
		<hr />

		<form id="filtro" onsubmit="return false;">
			<div class="row">
				<div class="col-12 col-md-4 pt-3">
					<label class="form-label" for="filtro-nome">Nome</label>
					<input class="form-control" type="text" id="filtro[nome]" name="filtro[nome]" placeholder="Busque por nome..." maxlength="255" autocomplete="off" />
				</div>

				<div class="col-12 col-md-3 pt-3">
					<label class="form-label" for="filtro-uf">UF</label>
					<select class="form-select" id="filtro-uf" name="filtro[uf]">
						<option value="" selected>Selecione uma opção</option>
						<option value="AC">Acre</option>
						<option value="AL">Alagoas</option>
						<option value="AP">Amapá</option>
						<option value="AM">Amazonas</option>
						<option value="BA">Bahia</option>
						<option value="CE">Ceará</option>
						<option value="DF">Distrito Federal</option>
						<option value="ES">Espírito Santo</option>
						<option value="GO">Goiás</option>
						<option value="MA">Maranhão</option>
						<option value="MT">Mato Grosso</option>
						<option value="MS">Mato Grosso do Sul</option>
						<option value="MG">Minas Gerais</option>
						<option value="PA">Pará</option>
						<option value="PB">Paraíba</option>
						<option value="PR">Paraná</option>
						<option value="PE">Pernambuco</option>
						<option value="PI">Piauí</option>
						<option value="RJ">Rio de Janeiro</option>
						<option value="RN">Rio Grande do Norte</option>
						<option value="RS">Rio Grande do Sul</option>
						<option value="RO">Rondônia</option>
						<option value="RR">Roraima</option>
						<option value="SC">Santa Catarina</option>
						<option value="SP">São Paulo</option>
						<option value="SE">Sergipe</option>
						<option value="TO">Tocantins</option>
					</select>
				</div>

				<div class="col-12 col-md-3 pt-3">
					<label class="form-label" for="filtro-categoria">Categoria</label>
					<select class="form-select" id="filtro-categoria" name="filtro[categoria]">
						<option value="" selected>Selecione uma opção</option>
					</select>
				</div>

				<div class="col-12 col-md-2 mt-auto pt-3">
					<button class="btn btn-primary w-100" type="button" onclick="carregarClientes()">
						<i class="bi bi-search"></i> Buscar
					</button>
				</div>
			</div>
		</form>

		<div class="d-grid justify-content-end my-3">
			<button class="btn btn-success" type="button" onclick="cadastrarCliente()">
				<i class="bi bi-plus-circle"></i> Novo Cliente
			</button>
		</div>

		<div class="table-responsive">
			<table class="table table-sm table-bordered table-striped align-middle" id="table-clientes">
				<thead class="table-dark align-middle">
					<tr>
						<th class="text-left">Nome</th>
						<th class="text-center">Tipo</th>
						<th class="text-center">UF</th>
						<th class="text-center">Categoria</th>
						<th class="text-center">Telefone</th>
						<th class="text-center">Data de <br /> Nasc./Fund.</th>
						<th class="text-center">Opções</th>
					</tr>
				</thead>

				<tbody></tbody>
				
				<tfoot class="text-muted"></tfoot>
			</table>

			<nav>
				<ul class="pagination justify-content-center" id="pagination-clientes"></ul>
			</nav>
		</div>
	</div>

	{{-- Modal do formulário de cadastro --}}
	<div class="modal fade" id="modal-cadastro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="label-cadastro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="label-cadastro"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<div class="modal-body">
					<form id="form-cadastro" onsubmit="return false;">
						<div class="row">
							<div class="col form-group">
								<input class="form-control" type="number" id="id" name="id" autocomplete="off" hidden />
							</div>
						</div>

						<div class="row">
							<div class="col form-group">
								<label class="form-label" for="nome">Nome <span class="text-danger">*</span></label>
								<input class="form-control" type="text" id="nome" name="nome" placeholder="Digite o nome do cliente" maxlength="255" autocomplete="off" required />
							</div>
						</div>

						<div class="row mt-4">
							<div class="col form-group">
								<label class="form-label" for="tipo">Tipo <span class="text-danger">*</span></label>
								<select class="form-select" id="tipo" name="tipo" required>
									<option value="">Selecione o tipo</option>
									<option value="PF">Pessoa Física</option>
									<option value="PJ">Pessoa Jurídica</option>
								</select>
							</div>
						</div>

						<div class="row mt-4">
							<div class="col form-group">
								<label class="form-label" for="uf">UF <span class="text-danger">*</span></label>
								<select class="form-select" id="uf" name="uf">
									<option value="" selected>Selecione uma opção</option>
									<option value="AC">Acre</option>
									<option value="AL">Alagoas</option>
									<option value="AP">Amapá</option>
									<option value="AM">Amazonas</option>
									<option value="BA">Bahia</option>
									<option value="CE">Ceará</option>
									<option value="DF">Distrito Federal</option>
									<option value="ES">Espírito Santo</option>
									<option value="GO">Goiás</option>
									<option value="MA">Maranhão</option>
									<option value="MT">Mato Grosso</option>
									<option value="MS">Mato Grosso do Sul</option>
									<option value="MG">Minas Gerais</option>
									<option value="PA">Pará</option>
									<option value="PB">Paraíba</option>
									<option value="PR">Paraná</option>
									<option value="PE">Pernambuco</option>
									<option value="PI">Piauí</option>
									<option value="RJ">Rio de Janeiro</option>
									<option value="RN">Rio Grande do Norte</option>
									<option value="RS">Rio Grande do Sul</option>
									<option value="RO">Rondônia</option>
									<option value="RR">Roraima</option>
									<option value="SC">Santa Catarina</option>
									<option value="SP">São Paulo</option>
									<option value="SE">Sergipe</option>
									<option value="TO">Tocantins</option>
								</select>
							</div>
						</div>

						<div class="row mt-4">
							<div class="col form-group">
								<label class="form-label" for="categoria">Categoria <span class="text-danger">*</span></label>
								<select class="form-select" id="categoria" name="categoria" required>
									<option value="">Selecione a categoria</option>
								</select>
							</div>
						</div>

						<div class="row mt-4">
							<div class="col form-group">
								<label class="form-label" for="data-nascimento">
									<span id="label-data-nascimento">Data de Nascimento</span> <span class="text-danger">*</span>
								</label>
								<input class="form-control" type="date" id="data-nascimento" name="data_nascimento" autocomplete="off" required />
							</div>
						</div>

						<div class="row mt-4">
							<div class="col form-group">
								<label class="form-label" for="telefone">Telefone <span class="text-danger">*</span></label>
								<input class="form-control" type="tel" id="telefone" name="telefone" placeholder="(XX) XXXXX-XXXX" maxlength="11" autocomplete="off" required />
							</div>
						</div>
					</form>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-success" onclick="salvarCliente()">
						Salvar
					</button>

					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
						Fechar
					</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript" src="{{ asset('/js/clientes.js') }}"></script>
@endsection