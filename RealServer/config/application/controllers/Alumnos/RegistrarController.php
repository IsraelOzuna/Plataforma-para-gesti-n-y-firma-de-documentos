<?php
class RegistrarController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Alumno_Model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $this->load->view('alumnos/Registrar_Alumno');        
    }    

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('correo', 'Correo', 'required');
        $this->form_validation->set_rules('matricula', 'Matricula', 'required');        
        $this->form_validation->set_rules('semestre', 'Semestre', 'required');
        $this->form_validation->set_rules('contrasena', 'Contrasena', 'required');

        $data = array();
        $data['nombre'] = $this->input->post('nombre');
        $data['correo'] = $this->input->post('correo');
        $data['matricula'] = $this->input->post('matricula');
        $data['semestre'] = $this->input->post('semestre');
        $data['contrasena'] = $this->input->post('contrasena');


        if ($this->form_validation->run() === FALSE)
        {            
            redirect('RegistrarController/index');            
        }
        else
        {
            $this->Alumno_Model->registrar_alumno($data);
            $this->load->view('pages/succes');
            //header("Location: ");
        }
    }
}