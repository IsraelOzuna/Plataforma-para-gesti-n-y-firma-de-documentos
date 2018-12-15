<?php
class IniciarSesionController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Academico_Model');
        $this->load->helper('url_helper');            
    }

    public function index()
    {       
        if($this->session->userdata('correo') != ''){                                    
            redirect('PaginaPrincipalController/index');                                     
        }
        $this->load->view('IniciarSesion');        
    }       

    public function iniciar(){        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('correo', 'Correo', 'required');
        $this->form_validation->set_rules('contrasena', 'Contrasena', 'required');

        $correo = $this->input->post('correo');
        $contrasena = $this->input->post('contrasena');

        
        if($this->Academico_Model->iniciarSesion($correo, $contrasena)){
            $this->session->set_userdata('correo', $correo);                        
            redirect('PaginaPrincipalController/index');                             
        }else{
            redirect('IniciarSesionController/index');                 
        }                    
    }

    public function cerrarSesion(){
        $this->session->sess_destroy();
        redirect('IniciarSesionController/index'); 
    }   
}