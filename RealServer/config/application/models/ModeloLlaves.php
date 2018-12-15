<?php
class ModeloLlaves extends CI_Model {

	public function __construct()
    { 
        $this->load->database();
    }	    

    public function registrarLlaves($correo,$llavePublica, $llavePrivada)
    {        
        $datos = array(        
            'correoAcademico' => $correo,
            'llavePublica' => $llavePublica,
            'llavePrivada' => $llavePrivada
        );
        return $this->db->insert('llaves', $datos);
    }      
}