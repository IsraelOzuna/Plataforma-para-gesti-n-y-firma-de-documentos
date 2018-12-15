<?php
class IniciarSesionController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Alumno_Model');
        $this->load->helper('url_helper');
    }

    public function index()
    {       
        if($this->session->userdata('matricula') != ''){            
            redirect('FormularioController/index');
        }
        $this->load->view('alumnos/Iniciar_Sesion');        
    }       

    public function iniciar(){        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('matricula', 'Matricula', 'required');
        $this->form_validation->set_rules('contrasena', 'Contrasena', 'required');

        $matricula = $this->input->post('matricula');
        $contrasena = $this->input->post('contrasena');

        if ($this->form_validation->run() === FALSE){
            redirect('IniciarSesionController/index'); 
        }else{
            if($this->Alumno_Model->iniciar_Sesion($matricula, $contrasena)){
                $this->session->set_userdata('matricula', $matricula);                
                redirect('FormularioController/index');
                
            }else{
                redirect('IniciarSesionController/index');                 
            }
        }                
    }

    public function cerrarSesion(){
        $this->session->sess_destroy();
        redirect('IniciarSesionController/index'); 
    }   
}