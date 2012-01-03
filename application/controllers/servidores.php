<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Servidores extends CI_Controller {

	public function index() {
		if ($this -> authmodel -> isLogged()) {
			$this -> load -> database();
			$this -> load -> library('pagination');
			$this -> load -> model('modulos');
			$config['base_url'] = site_url('servidores/index');
			$config['total_rows'] = $this -> db -> count_all('categorias');
			$config['per_page'] = '10';
			$this -> pagination -> initialize($config);

			$params['links'] = $this -> pagination -> create_links();

			$this -> db -> limit($config['per_page'], $this -> uri -> segment(3));
			$query = $this -> db -> get('servidores');

			$params['Servidores'] = $query -> result();

			$header['login'] = $this -> authmodel -> link();
			$header['menu'] = $this -> modulos -> menu();
			// Carrega a página
			$this -> load -> view('header', $header);
			$this -> load -> view('servidores_view', $params);
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
			$this -> form_validation -> set_rules('IP', 'IP', 'required');
			$this -> form_validation -> set_rules('username', 'username', 'required');
			$this -> form_validation -> set_rules('password', 'password', 'required');
			$this -> form_validation -> set_rules('Local', 'Local', 'required');
			$this -> form_validation -> set_rules('Observacao', 'Observacao', 'required');

			if ($this -> form_validation -> run() == FALSE) {
				$header['login'] = $this -> authmodel -> link();
				$header['menu'] = $this -> modulos -> menu();
				// Carrega a página
				$this -> load -> view('header', $header);
				$this -> load -> view('servidores_cad');
				$this -> load -> view('footer');
			} else {
				// Dados para serem gravados no banco
				$data = array(
					'hostname' => $this -> input -> post('hostname'), 
					'IP' => $this -> input -> post('IP'), 
					'username' => $this -> input -> post('username'),
					'password' => $this -> input -> post('password'), 
					'Local' => $this -> input -> post('Local'), 
					'Observacao' => $this -> input -> post('Observacao')
				);
				// Grava no Banco de dados
				$this -> db -> insert('servidores', $data);
				// Atualizando o PfSense
				redirect('servidores');
			}
		} else {
			redirect('auth');
		}
	}

	public function excluir($id) {
		if ($this -> authmodel -> isLogged()) {
			$this -> load -> database();
			$this -> db -> where('idServidor', $id);
			$this -> db -> delete('servidores');
			redirect('servidores');
		} else {
			redirect('auth');
		}
	}

	function editar($id) {
		if ($this -> authmodel -> isLogged()) {
			$this -> load -> helper(array('form'));
			$this -> load -> model('modulos');
			$this -> load -> database();
			$this -> db -> where('idServidor', $id);
			$query = $this -> db -> get('servidores');
			$Servidores = $query -> result();
			foreach ($Servidores as $row) {

			}
			$params['idServidor'] = $row -> idServidor;
			$params['hostname'] = array('name' => 'hostname', 'id' => 'hostname', 'value' => $row -> hostname, 'size' => '50', );
			$params['IP'] = array('name' => 'IP', 'id' => 'IP', 'value' => $row -> IP, 'size' => '15', );
			$params['username'] = array('name' => 'username', 'id' => 'username', 'value' => $row -> username, 'size' => '50', );
			$params['password'] = array('name' => 'password', 'id' => 'password', 'value' => $row -> password, 'size' => '50', );
			$params['local'] = array('name' => 'Local', 'id' => 'Local', 'value' => $row -> Local, 'size' => '50', );
			$params['observacao'] = array('name' => 'Observacao', 'id' => 'Observacao', 'value' => $row -> Observacao, 'size' => '50', );
			$params['status'] = array('name' => 'Status', 'id' => 'Status', 'value' => $row -> Status, 'checked' => $row -> Status, );
			if ($row -> Status) {
				$params['status_label'] = "Ativo</p>";
			} else {
				$params['status_label'] = "Desativado</p>";
			}
			$header['login'] = $this -> authmodel -> link();
			$header['menu'] = $this -> modulos -> menu();
			$this -> load -> view('header', $header);
			$this -> load -> view('servidores_editar', $params);
			$this -> load -> view('footer');
		} else {
			redirect('auth');
		}
	}

	function atualizar() {
		if ($this -> authmodel -> isLogged()) {
			$this -> load -> library('form_validation');
			$this -> load -> database();

			// Validação do formulário
			$this -> form_validation -> set_rules('idServidor', 'idServidor', 'required');
			$this -> form_validation -> set_rules('IP', 'IP', 'required');
			$this -> form_validation -> set_rules('username', 'username', 'required');
			$this -> form_validation -> set_rules('password', 'password', 'required');
			$this -> form_validation -> set_rules('Local', 'Local', 'required');
			$this -> form_validation -> set_rules('Observacao', 'Observacao', 'required');
			$this -> form_validation -> set_rules('Status', 'Status', 'required');

			$data = array(
				'URL' => $this -> input -> post('URL'), 
				'username' => $this -> input -> post('username'),
				'password' => $this -> input -> post('password'), 
				'Local' => $this -> input -> post('Local'), 
				'Observacao' => $this -> input -> post('Observacao'), 
				'Status' => $this -> input -> post('Status')
			);

			$this -> db -> where('idServidor', $this -> input -> post('idServidor'));
			$this -> db -> update('servidores', $data);
			redirect('servidores');
		} else {
			redirect('auth');
		}
	}

}
