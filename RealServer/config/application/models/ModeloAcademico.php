<?php
class ModeloAcademico extends CI_Model {

	public function __construct()
    { 
        $this->load->database();
    }	
        
    public function iniciarSesion($correo, $contrasena)
    {
        $this->db->where('correo', $correo);        
        $this->db->where('contrasena', hash("sha256",$contrasena));
        $academico = $this->db->get('Academico');
        return $academico->result_array();
    }      

    public function registrarAcademico($academico)
    {
        $academico['contrasena'] = hash("sha256", $academico['contrasena']);
        $datos = array(        
            'nombre' => $academico['nombre'],
            'correo' => $academico['correo'],
            'apellidos' => $academico['apellidos'],
            'telefono' => $academico['telefono'],
            'contrasena' => $academico['contrasena']
        );
        return $this->db->insert('Academico', $datos);
    }

    public function obtenerDatosAcademico($correo){
        $this->db->where('correo', $correo);
        $datosAcademico = $this->db->get('academico');
        return $datosAcademico->result_array();
    }

    public function editarAcademico($academico)
    {   
        $academico['contrasena'] = hash("sha256", $academico['contrasena']);             
        $datos = array(        
            'nombre' => $academico['nombre'],
            'correo' => $academico['correo'],
            'apellidos' => $academico['apellidos'],
            'telefono' => $academico['telefono'],
            'contrasena' => $academico['contrasena']
        );
        $this->db->where('correo', $academico['correo']);
        return $this->db->update('Academico', $datos);
    }

    public function verificarCorreoExistente($correo){
        $this->db->where('correo', $correo);
        $correoExistente = false;
        $resultado = $this->db->get('academico');
        if ($resultado->num_rows() > 0) {
            $correoExistente = true;
        }
        return $correoExistente;
    }


    public function cambiarContrasena($academico){
        $academico['nuevaContrasena'] = hash("sha256", $academico['nuevaContrasena']);
        $nuevaContrasena = array(
            'contrasena' => $academico['nuevaContrasena']
        );
        $this->db->where('correo', $academico['correo']);
        return $this->db->update('Academico', $nuevaContrasena);
    }
}