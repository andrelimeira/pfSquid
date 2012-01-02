<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Urls extends CI_Controller {

    public function index() {
        if ($this->authmodel->isLogged()) {
        	$this -> load -> model('modulos');
            $header['login'] = $this->authmodel->link();
			$header['menu'] = $this -> modulos -> menu();
            // Carrega a página
            $this->load->view('header', $header);
            $this->load->view('urls_view');
            $this->load->view('footer');
        } else {
            redirect('auth');
        }
    }

}