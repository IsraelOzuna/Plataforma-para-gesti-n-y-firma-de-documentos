<?php
class Alumno_Model extends CI_Model {

	public function __construct()
    { 
        $this->load->database();
    }

	public function registrar_alumno($alumno)
	{
        $alumno['contrasena'] = hash("sha256", $alumno['contrasena']);
        $datos = array(        
            'nombre' => $alumno['nombre'],
            'correo' => $alumno['correo'],
            'matricula' => $alumno['matricula'],
            'semestre' => $alumno['semestre'],
            'contrasena' => $alumno['contrasena']
        );
        return $this->db->insert('registros', $datos);
	}

    public function iniciar_Sesion($matricula, $contrasena)
    {
        $this->db->where('matricula', $matricula);        
        $this->db->where('contrasena', hash("sha256",$contrasena));
        $confirmacion = $this->db->get('registros'); 
        $existe = false;        
        if($confirmacion->num_rows()>0){
            $existe = true;
        }
        return $existe;
    }    

    public function get_Alumnos()
    {
        $query = $this->db->get('registros');
        return $query->result_array();
    } 

    public function editar_Alumno($alumno)
    {   
        $alumno['contrasena'] = hash("sha256", $alumno['contrasena']);             
        $datos = array(
            'nombre' => $alumno['nombre'],
            'correo' => $alumno['correo'],
            'semestre' => $alumno['semestre'],
            'contrasena' => $alumno['contrasena']
        );
        $this->db->where('matricula', $alumno['matricula']);
        return $this->db->update('registros', $datos);
    }    
}