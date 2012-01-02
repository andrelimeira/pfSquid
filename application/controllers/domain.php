<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Domain extends CI_Controller {

	public function index() {
		if ($this -> authmodel -> isLogged()) {
			$this -> load -> database();
			$this -> load -> library('pagination');
			$this -> load -> model('modulos');
			// Cria paginação
			$config['base_url'] = site_url('domain/index');
			$config['total_rows'] = $this -> db -> count_all('dominios');
			$config['per_page'] = '10';
			$this -> pagination -> initialize($config);
			// repassa para a view
			$params['links'] = $this -> pagination -> create_links();
			// Seleciona os domínios
			$this -> db -> select('idDominio, Dominio, NameCategoria');
			$this -> db -> from('dominios');
			$this -> db -> join('categorias', 'categorias.Name = dominios.NameCategoria');
			if ($this -> input -> post('Dominio')) {
				$this -> db -> like('Dominio', $this -> input -> post('Dominio'));
			}
			if ($this -> input -> post('NameCategoria')) {
				$this -> db -> like('NameCategoria', $this -> input -> post('NameCategoria'));
			}
			$this -> db -> limit($config['per_page'], $this -> uri -> segment(3));
			$query = $this -> db -> get();
			// repassa para a view
			$params['Dominios'] = $query -> result();

			// Seleciona as categorias
			$this -> db -> select('*');
			$this -> db -> from('categorias');
			$query = $this -> db -> get();
			// repassa para a view
			$params['categorias'] = $query -> result();
			$header['login'] = $this -> authmodel -> link();
			$header['menu'] = $this -> modulos -> menu();
			// Carrega a página
			$this -> load -> view('header', $header);
			$this -> load -> view('domain_view', $params);
			$this -> load -> view('footer');
		} else {
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
			$this -> form_validation -> set_rules('Dominio', 'Dominio', 'required');
			$this -> form_validation -> set_rules('NameCategoria', 'NameCategoria', 'required');

			if ($this -> form_validation -> run() == FALSE) {
				$query_categorias = $this -> db -> get('categorias');
				$params['Categorias'] = $query_categorias -> result();
				$header['login'] = $this -> authmodel -> link();
				$header['menu'] = $this -> modulos -> menu();
				// Carrega a página
				$this -> load -> view('header', $header);
				$this -> load -> view('domain_cad', $params);
				$this -> load -> view('footer');
			} else {
				// Dados para serem gravados no banco
				$data = array('Dominio' => $this -> input -> post('Dominio'), 'NameCategoria' => $this -> input -> post('NameCategoria'));
				// Grava no Banco de dados
				$this -> db -> insert('dominios', $data);
				if ($this -> input -> post('sincro') == 1) {
					// Atualizando o PfSense
					$this -> load -> model('comunica');
					$this -> comunica -> setDominio($this -> input -> post('Dominio'), $this -> input -> post('NameCategoria'));
				}
				redirect('domain');
			}
		} else {
			redirect('auth');
		}
	}

	public function lista() {
		if ($this -> authmodel -> isLogged()) {
			$this -> load -> helper(array('form'));
			$this -> load -> library('form_validation');
			$this -> load -> model('modulos');
			$this -> load -> database();
			// Validação do formulário
			$this -> form_validation -> set_rules('Dominios', 'Dominios', 'required');
			$this -> form_validation -> set_rules('NameCategoria', 'NameCategoria', 'required');

			if ($this -> form_validation -> run() == FALSE) {
				$query_categorias = $this -> db -> get('categorias');
				$params['Categorias'] = $query_categorias -> result();
				$header['login'] = $this -> authmodel -> link();
				$header['menu'] = $this -> modulos -> menu();
				$this -> load -> view('header', $header);
				$this -> load -> view('domain_lista', $params);
				$this -> load -> view('footer');
			} else {
				$dominios = explode("\n", $this -> input -> post('Dominios'));
				foreach ($dominios as $dominio) {
					// Dados para serem gravados no banco
					$data = array('Dominio' => $dominio, 'NameCategoria' => $this -> input -> post('NameCategoria'));
					// Grava no Banco de dados
					$this -> db -> insert('dominios', $data);
					// Atualizando o PfSense
					//$bool = $this->load->model('comunica');
					//if($bool)
					//$this->comunica->setDominio($dominio, $this->input->post('NameCategoria'));
				}
				redirect('domain');
			}
		} else {
			redirect('auth');
		}
	}

	public function excluir($id) {
		if ($this -> authmodel -> isLogged()) {
			$this -> load -> database();
			$this -> db -> where('idDominio', $id);
			$this -> db -> delete('dominios');
			redirect('domain');
		} else {
			redirect('auth');
		}
	}

}
