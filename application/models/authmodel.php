<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class authmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function isValidLogin() {
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run()) {
            $this->load->database();
            $this->db->where('username', $this->input->post('username'));
            $this->db->where('password', sha1($this->input->post('password')));
            $query = $this->db->get('auth');
            //verificar se retornou 1 resultado se sim usuário e senha ok
            if ($query->num_rows() == 1) {
                $user = $query->result();
                $newdata = array(
                    'username' => $user[0]->username,
                    'password' => $user[0]->password,
                    'Name' => $user[0]->Name,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($newdata);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function changepassword() {
        // Valida o post
        if ($this->input->post('old_password') and $this->input->post('new_password') and $this->input->post('new_password2')) {
            // confere se as duas senhas estão iguais
            if ($this->input->post('new_password') == $this->input->post('new_password2')) {
                // confere se a antiga senha está correta
                /*
                 * TODO : talvez seja mais seguro verificar no banco ao invés de session
                 * porém por session é mais rápido (teoricamente)
                 */
                if ($this->input->post('old_password') == $this->session->userdata('password')) {
                    $data = array(
                        'password' => $this->session->userdata('password')
                    );
                    $this->load->database();
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('auth', $data);

                    $query = $this->db->get('auth');
                }
            }
        } else {
            return "not OK";
        }
    }

    function link() {
        if ($this->isLogged()) {
            return sprintf("Logado como <a href=\"%s\">%s</a>, (<a href=\"%s\">Logout</a>)", site_url('auth/perfil'), $this->session->userdata('username'), site_url('auth/logout'));
        } else {
            return "";
        }
    }

    function doLogout() {
        $this->load->library('session');
        $newdata = array(
            'logged_in' => FALSE
        );
        $this->session->set_userdata($newdata);
    }

    function isLogged() {
        $this->load->library('session');
        if ($this->session->userdata('logged_in') == TRUE) {
            return true;
        } else {
            return false;
        }
    }

}

?>
