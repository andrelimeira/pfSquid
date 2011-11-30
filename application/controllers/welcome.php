<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {
        if ($this->authmodel->isLogged()) {
            $this->load->model('status');
            $params['categorias'] = $this->status->Categorias();
            $header['login'] = $this->authmodel->link();
            $this->load->view('header', $header);
            $this->load->view('welcome_message', $params);
            $this->load->view('footer');
        } else {
            redirect('auth');
        }
    }

}