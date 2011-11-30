<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class status extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function Categorias() {
        $this->db->select('Name');
        $query = $this->db->get('categorias');
        $total = array();
        if ($query->num_rows() > 1) {
            $categorias = $query->result();
            foreach ($categorias as $categoria) {
                $this->db->select('count(*) as total, Descricao');
                $this->db->from('dominios');
                $this->db->join('categorias', 'categorias.Name = dominios.NameCategoria');
                $this->db->where('categorias.Name', $categoria->Name);
                $query = $this->db->get();
                $total[] = $query->result();
            }
        }
        return $total;
    }

}

?>
