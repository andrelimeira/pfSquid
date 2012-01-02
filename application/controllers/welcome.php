<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index() {
		if ($this -> authmodel -> isLogged()) {
			$this -> load -> model('status');
			$this -> load -> model('modulos');
			$params['categorias'] = $this -> status -> Categorias();
			$params['servidores'] = $this -> status -> Servidores();
			$header['login'] = $this -> authmodel -> link();
			$header['menu'] = $this -> modulos -> menu();
			$this -> load -> view('header', $header);
			$this -> load -> view('welcome_message', $params);
			$this -> load -> view('footer');
		} else {
			redirect('auth');
		}
	}

}
