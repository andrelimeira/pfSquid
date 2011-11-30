<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class modulos extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function show() {
        /*
         * Código fonte retirado de :
         * http://stackoverflow.com/questions/5919546/how-to-list-all-controller-class-name-in-codeigniter
         */
        $controllers = array();
        $this->load->helper('file');

        /* Scan files in the /application/controllers directory
         * Set the second param to TRUE or remove it if you
         * don't have controllers in sub directories
         */
        $files = get_dir_file_info(APPPATH . 'controllers', FALSE);

        /* Loop through file names removing .php extension */
        foreach (array_keys($files) as $file) {
            if ($file != "index.html") {
                $controllers[] = str_replace(EXT, '', $file);
            }
        }
       return $controllers; // Array with all our controllers
    }

}

?>
