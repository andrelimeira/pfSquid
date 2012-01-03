<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index() {
		if ($this -> authmodel -> isLogged()) {
			redirect('welcome');
		} else {
			$this -> load -> helper(array('form'));
			$params['username'] = array('name' => 'username', 'id' => 'username', 'size' => '30', );
			$params['password'] = array('name' => 'password', 'id' => 'password', 'size' => '30', );
			$header['login'] = $this -> authmodel -> link();
			$header['menu'] = "";
			$this -> load -> view('header', $header);
			$this -> load -> view('auth_form', $params);
			$this -> load -> view('footer');
		}
	}

	function login() {
		if ($this -> authmodel -> isValidLogin()) {
			redirect('welcome');
		} else {
			redirect('auth');
		}
	}

	function logout() {
		$this -> authmodel -> doLogout();
		redirect('welcome');
	}

	function perfil() {
		if ($this -> authmodel -> isLogged()) {
			// Carrega módulos e bibliotecas
			$this -> load -> model('status');
			$this -> load -> model('modulos');
			$this -> load -> library('session');

			// menu login
			$header['login'] = $this -> authmodel -> link();
			$header['menu'] = $this -> modulos -> menu();

			// dados do usuário
			$params['username'] = $this -> session -> userdata('username');
			$params['Name'] = $this -> session -> userdata('Name');
			$params['modulos'] = $this -> modulos -> show();
			$params['msg'] = $this -> authmodel -> changepassword();

			//carrega as views
			$this -> load -> view('header', $header);
			$this -> load -> view('meuperfil', $params);
			$this -> load -> view('footer');
		} else {
			redirect('auth');
		}
	}

}
