<?php
class ModeloMensaje extends CI_Model {

        public function __construct()
        { 
                $this->load->database();
        }

        public function obtenerMensajes($correo)
        {
            $this->db->where('receptor',$correo);
            $query = $this->db->get('mensaje');
            return $query->result_array();
        }

        public function guardarMensaje($datos)
        {
          return $this->db->insert('mensaje', $datos);
         }
}
