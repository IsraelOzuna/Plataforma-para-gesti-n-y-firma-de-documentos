<?php
class Maestro_Model extends CI_Model {

	public function __construct()
    { 
        
    }

    public function iniciarSesion($correo, $contrasena)
    {
        $this->db->where('correo', $correo);        
        $this->db->where('contrasena', hash("sha256",$contrasena));
        $confirmacion = $this->db->get('cuenta'); 
        $existe = false;        
        if($confirmacion->num_rows()>0){
            $existe = true;
        }
        return $existe;
    }    
}