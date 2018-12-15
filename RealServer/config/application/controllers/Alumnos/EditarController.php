<?php
class EditarController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Alumno_Model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        if($this->session->userdata('matricula') != ''){  
            $this->load->view('templates/header');
            $this->load->view('alumnos/Editar_Perfil');        
        }else{
            redirect('IniciarSesionController/index');
        }
    }    

    public function edit()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('correo', 'Correo', 'required');               
        $this->form_validation->set_rules('semestre', 'Semestre', 'required');
        $this->form_validation->set_rules('contrasena', 'Contrasena', 'required');

        $data = array();
        $data['nombre'] = $this->input->post('nombre');
        $data['matricula'] = $this->session->userdata('matricula');
        $data['correo'] = $this->input->post('correo');        
        $data['semestre'] = $this->input->post('semestre');
        $data['contrasena'] = $this->input->post('contrasena');


        if ($this->form_validation->run() === FALSE)
        {            
            redirect('EditarController/index');            
        }
        else
        {
            $this->Alumno_Model->editar_Alumno($data);
            redirect('pages/succes');            
        }
    }
}