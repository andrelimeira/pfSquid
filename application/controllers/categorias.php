<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public function index() {
		// se estiver autenticado
		if ($this -> authmodel -> isLogged()) {
			$this -> load -> database();
			$this -> load -> library('pagination');
			$this -> load -> model('modulos');
			// Configura a paginação
			$config['base_url'] = site_url('categorias/index');
			$config['total_rows'] = $this -> db -> count_all('categorias');
			$config['per_page'] = '10';
			// Inicializa a paginação
			$this -> pagination -> initialize($config);
			// cria os links da paginação
			$params['links'] = $this -> pagination -> create_links();
			// obtêm a lista de categorias do banco de dados
			$this -> db -> limit($config['per_page'], $this -> uri -> segment(3));
			$query = $this -> db -> get('categorias');
			// repassa para a página,...
			$params['Categorias'] = $query -> result();
			// obtêm a lista de servidores ativos do banco de dados
			$this -> db -> where('status', true);
			$query = $this -> db -> get('servidores');
			// repassa para a página,...
			$params['servidores'] = $query -> result();
			$header['login'] = $this -> authmodel -> link();
			$header['menu'] = $this -> modulos -> menu();
			// Carrega a página
			$this -> load -> view('header', $header);
			$this -> load -> view('categorias_view', $params);
			$this -> load -> view('footer');
		} else {
			// senão estiver autenticado redireciona para a página de autenticação
			redirect('auth');
		}
	}

	public function cadastro() {
		if ($this -> authmodel -> isLogged()) {
			$this -> load -> helper(array('form'));
			$this -> load -> library('form_validation');
			$this -> load -> model('modulos');
			$this -> load -> database();

			// Validação do formulário
			$this -> form_validation -> set_rules('Name', 'Nome', 'required');
			$this -> form_validation -> set_rules('Descricao', 'Descrição', 'required');

			if ($this -> form_validation -> run() == FALSE) {
				$header['login'] = $this -> authmodel -> link();
				$header['menu'] = $this -> modulos -> menu();
				// Carrega a página
				$this -> load -> view('header', $header);
				$this -> load -> view('categorias_cad');
				$this -> load -> view('footer');
			} else {
				// Dados para serem gravados no banco
				$data = array('Name' => $this -> input -> post('Name'), 'Descricao' => $this -> input -> post('Descricao'));
				// Grava no Banco de dados
				$this -> db -> insert('categorias', $data);
				// Atualizando o PfSense
				// TODO implementar

				redirect('categorias');
			}
		} else {
			redirect('auth');
		}
	}

	public function excluir($id) {
		if ($this -> authmodel -> isLogged()) {
			$this -> load -> database();
			// Primeiro remove os domínios desta categoria
			$this -> db -> where('NameCategoria', $id);
			$this -> db -> delete('dominios');
			// depois remove a categoria
			$this -> db -> where('Name', $id);
			$this -> db -> delete('categorias');
			redirect('categorias');
		} else {
			redirect('auth');
		}
	}

	public function sincro() {
		if ($this -> authmodel -> isLogged()) {
			$this -> load -> database();
			$query = $this -> db -> get('servidores');
			// para cada servidor existente no post
			foreach ($query->result() as $server) {
				if ($this -> input -> post($server -> idServidor)) {
					$this -> load -> model('comunica');
					// Comunica com o servidor e envia todos os itens da categoria selecionada
					$this -> comunica -> sendCategoria($this -> input -> post('categoria'), $server -> idServidor);
				}
			}
			redirect('categorias');
		} else {
			redirect('auth');
		}
	}

}
