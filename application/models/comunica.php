<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class comunica extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function setDominio($dominio, $categoria) {
        $this->load->library('xmlrpc');
        $query = $this->db->get('servidores');
        foreach ($query->result() as $servidores) {
            $this->xmlrpc->server($servidores->URL, 80);
            $this->xmlrpc->method('pfsense.allow_site');
            $request = array($servidores->password, $dominio, $categoria);
            $this->xmlrpc->request($request);
            if (!$this->xmlrpc->send_request()) {
                echo $this->xmlrpc->display_error();
            }
        }
    }

    function sendCategoria($categoria, $servidor) {
        // pega os dados necessários do servidor para conexão
        $this->db->where('idServidor', $servidor);
        $qserver = $this->db->get('servidores');
        // pega todos os dominios de uma categoria
        $this->db->select('Dominio');
        $this->db->from('dominios');
        $this->db->join('categorias', 'categorias.Name = dominios.NameCategoria');
        $this->db->where('Name', $categoria);
        $query = $this->db->get();
        $dominios = '';
        foreach ($query->result() as $dominio) {
            if (empty($dominios)) {
                $dominios = $dominio->Dominio;
            } else {
                $dominios .= " " . $dominio->Dominio;
            }
        }
        // Conecta no servidor

        $this->load->library('xmlrpc');
        foreach ($qserver->result() as $servidor) {
            $this->xmlrpc->server($servidor->URL, 80);
            $this->xmlrpc->method('pfsense.sendCategoriaDomain');
            $request = array($servidor->password, $dominios, $categoria);
            $this->xmlrpc->request($request);
            if (!$this->xmlrpc->send_request()) {
                echo $this->xmlrpc->display_error();
            }
        }
    }

}

?>