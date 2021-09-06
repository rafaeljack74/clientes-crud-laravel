var urlApi = window.location.protocol + '//' + window.location.host + '/api';

var categorias = [];

// configuração do SweetAlert
const swal = Swal.mixin({
	customClass: {
		confirmButton: 'btn btn-success mx-1',
		cancelButton: 'btn btn-danger mx-1'
	},
	buttonsStyling: false
});

/**
 * Funções inicializadas assim que a página é carregada.
 */
$(document).ready(function () {
	carregarCategorias();
	carregarClientes();

	var campoTelefone = $('#telefone');
	var campoTipo = $('#tipo');

	// atribui máscara de acordo como tamanho do telefone informado
	campoTelefone.mask('(00) 0000-00000');
	campoTelefone.on('change', function () {
		if ($(this).val().length >= 15)
			campoTelefone.mask('(00) 00000-0000');
		else
			campoTelefone.mask('(00) 0000-00000');
	});

	// atribui label específico para data de nascimento/fundação de acordo com o tipo
	campoTipo.on('change', function () {
		if (campoTipo.val() === 'PF')
			$('#label-data-nascimento').text('Data de Nascimento');
		else
			$('#label-data-nascimento').text('Data de Fundação');
	});

});

/**
 * Inicializa a variável de categorias e prepara o combo do filtro.
 */
function carregarCategorias() {
	$.ajax({
		url: urlApi + '/categorias',
		headers: {
			'Accept': 'application/json'
		},
		success: function (data) {
			this.categorias = data.categorias;

			let selectFiltroCategoria = $('#filtro-categoria');
			let selectFormCategoria   = $('#categoria');

			this.categorias.map((categoria) => {
				$(selectFiltroCategoria).append(`
					<option value="${categoria.id}">
						${categoria.nome}
					</option>
				`);

				$(selectFormCategoria).append(`
					<option value="${categoria.id}">
						${categoria.nome}
					</option>
				`);
			});
		},
		error: function () {
			swal.fire({
				icon: 'error',
				title: 'Erro!',
				text: 'Ocorreu um problema ao carregar as categorias!'
			});
		}
	});
}

/**
 * Atualiza os dados da tabela.
 *
 * @param {int} page
 */
function carregarClientes(page = 1) {
	var tbody = $('#table-clientes tbody');
	var tfoot = $('#table-clientes tfoot');

	var params = '?' + $('#filtro').serialize() + '&page=' + page;

	$.ajax({
		url: urlApi + '/clientes' + params,
		headers: {
			'Accept': 'application/json'
		},
		beforeSend: function() {
			tbody.empty();
			tfoot.empty();

			// exibe loading na tabela
			tbody.append(`
				<tr>
					<td class="text-center" colspan="7">
						<div class="spinner-border my-3" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</td>
				</tr>
			`);
		},
		success: function (data) {
			var pagination = $('#pagination-clientes');
			var clientes = data.clientes.data;

			// limpando dados da tabela
			tbody.empty();
			tfoot.empty();
			pagination.empty();

			if (clientes.length > 0) {
				// preparando exibição dos dados retornados
				clientes.map((cliente) => {
					tbody.append(`
						<tr>
							<td class="text-left">
								${cliente.nome}
							</td>

							<td class="text-center">
								${cliente.tipo === "PF" ? "Pessoa Física" : "Pessoa Jurídica"}
							</td>

							<td class="text-center">
								${cliente.uf}
							</td>

							<td class="text-center">
								${cliente.categoria.nome}
							</td>

							<td class="text-center">
								${formatarTelefone(cliente.telefone)}
							</td>

							<td class="text-center">
								${formatarData(cliente.data_nascimento)}
							</td>

							<td class="text-center">
								<div class="btn-group" role="group" aria-label="Opções"">
									<button class="btn btn-warning btn-small" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" onclick="editarCliente(${cliente.id})">
										<i class="bi bi-pencil-square"></i>
									</button>

									<button class="btn btn-danger btn-small" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir" onclick="excluirCliente(${cliente.id})">
										<i class="bi bi-trash"></i>
									</button>
								</btn>
							</td>
						</tr>
					`);
				});

				var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
				tooltipTriggerList.map(function (tooltipTriggerEl) {
					return new bootstrap.Tooltip(tooltipTriggerEl);
				})


				tfoot.append(`
					<tr>
						<td colspan="7">
							Exibindo ${data.clientes.from} até ${data.clientes.to} de ${data.clientes.total} registros.
						</td>
					</tr>
				`);

				// preparando paginação
				let links = data.clientes.links;

				links.map((link) => {
					let url = link.url;
					let page = url !== null ? url.split("page=")[1] : '';

					pagination.append(`
						<li class="page-item ${url === null ? 'disabled' : ''} ${link.active ? 'active' : ''}">
							<a class="page-link" href="#" onclick="carregarClientes(${page})">
								${link.label}
							</a>
						</li>
					`);
				});
			}
			else
				tfoot.append(`
					<tr>
						<td colspan="7">
							Nenhum registro encontrado.
						</td>
					</tr>
				`);
		}
	});
}

/**
 * Abre formulário para cadastro de novo cliente.
 */
function cadastrarCliente() {
	$('#label-cadastro').text('Novo Cadastro');

	$('#id').val('');
	$('#nome').val('');
	$('#tipo').val('').trigger('change');
	$('#uf').val('');
	$('#categoria').val('');
	$('#data-nascimento').val('');
	$('#telefone').val('').trigger('input').trigger('change');

	$('#modal-cadastro').modal('show');
}

/**
 * Abre formulário para edição dos dados do cliente informado.
 * 
 * @param {int} id
 */
function editarCliente(id) {
	$('#label-cadastro').text('Edição de Cadastro');

	$.ajax({
		url: urlApi + '/clientes/' + id,
		headers: {
			'Accept': 'application/json'
		},
		method: 'get',
		success: function (data) {
			$('#id').val(data.cliente.id);
			$('#nome').val(data.cliente.nome);
			$('#tipo').val(data.cliente.tipo).trigger('change');
			$('#uf').val(data.cliente.uf);
			$('#categoria').val(data.cliente.categoria_id);
			$('#data-nascimento').val(data.cliente.data_nascimento);
			$('#telefone').val(data.cliente.telefone).trigger('input').trigger('change');

			$('#modal-cadastro').modal('show');
		},
		error: function () {
			swal.fire({
				title: 'Ops!',
				text: 'Ocorreu um problema ao buscar os dados do cliente! Favor tentar novamente.',
				icon: 'error'
			});
		}
	});
}

/**
 * Salva os dados do cliente (seja inclusão ou alteração)
 */
function salvarCliente() {
	var formData = new FormData($('#form-cadastro')[0]);
	var cliente = Object.fromEntries(formData);

	var method = 'post';

	cliente.telefone = cliente.telefone.replace(/[() -]/g, '');

	if (cliente.id !== '')
		method = 'put';

	$.ajax({
		url: urlApi + '/clientes/' + cliente.id,
		headers: {
			'Accept': 'application/json',
			'Content-Type' : 'application/json'
		},
		method: method,
		data: JSON.stringify(cliente),
		success: function (data) {
			swal.fire({
				title: 'Sucesso!',
				text: data.success,
				icon: 'success'
			})

			$('#modal-cadastro').modal('hide');

			carregarClientes();
		},
		error: function (data) {
			var title = 'Ops!';
			var mensagem = 'Ocorreu um problema ao salvar os dados do cliente! Favor tentar novamente.';
			var icon = 'error';

			if (data.status >= 400 && data.status < 500) {
				title = 'Atenção!';
				mensagem = '';
				icon = 'warning';

				var erros = Object.values(data.responseJSON.errors);

				erros.forEach((erro) => {
					mensagem += erro + '<br />';
				});
			}

			swal.fire({
				title: title,
				html: mensagem,
				icon: icon
			});
		}
	});
}

/**
 * Realiza exclusão do cliente informado.
 * 
 * @param {int} id
 */
function excluirCliente(id) {
	swal.fire({
		title: 'Atenção!',
		text: 'Tem certeza de que deseja excluir esse cliente?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Sim',
		cancelButtonText: 'Cancelar',
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: urlApi + '/clientes/' + id,
				headers: {
					'Accept': 'application/json'
				},
				method: 'delete',
				success: function (data) {
					swal.fire({
						title: 'Sucesso!',
						text: data.success,
						icon: 'success'
					});

					// atualiza a grid
					carregarClientes();
				},
				error: function (data) {
					swal.fire({
						title: 'Ops!',
						text: 'Ocorreu um problema durante a exclusão! Favor tentar novamente.',
						icon: 'error'
					});
				}
			});
		}
	});
}

/**
 * Formata uma data informada para o layout dd/mm/yyyy
 * 
 * @param {string} date
 * @return {string}
 */
function formatarData(date) {
	var ano = date.substring(0, 4);
	var mes = date.substring(5, 7);
	var dia = date.substring(8, 10);

	return dia + '/' + mes + '/' + ano;
}

/**
 * Formata o telefone informado para o layout (XX) XXXXX-XXXX
 * 
 * @param {string} numero
 * @return {string}
 */
function formatarTelefone(numero) {
	var ddd = numero.substring(0, 2);
	var telefone = numero.substring(2);
	var posHifen = telefone.length == 9 ? 5 : 4;

	var parte1 = telefone.substring(0, posHifen);
	var parte2 = telefone.substring(posHifen);

	return `
		(${ddd}) ${parte1}-${parte2}
	`;
}