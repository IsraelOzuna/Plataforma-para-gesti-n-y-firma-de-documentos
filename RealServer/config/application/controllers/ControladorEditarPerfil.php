<?php
class ControladorEditarPerfil extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModeloAcademico');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        if($this->session->userdata('correo') != ''){  
            $correo = $this->session->userdata('correo');
            $datosAcademico = $this->ModeloAcademico->obtenerDatosAcademico($correo);                             
            $academico['nombre'] =  $this->session->userdata('nombre') ;        
            $this->load->view('Encabezado', $academico);       
            $this->load->view('VistaEditarPerfil', $datosAcademico[0]);
        }else{
            $this->load->view('VistaIniciarSesion');        
        }             
    }  

    public function editarAcademico()
    {
        if($this->session->userdata('correo') != ''){  
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nombre', 'nombre', 'required');
        $this->form_validation->set_rules('apellidos', 'apellidos', 'required');               
        $this->form_validation->set_rules('telefono', 'telefono', 'required');
        $this->form_validation->set_rules('contrasena', 'Contrasena', 'required');

        $datosAcademico = array();
        $datosAcademico['nombre'] = $this->input->post('nombre');
        $datosAcademico['correo'] = $this->session->userdata('correo');
        $datosAcademico['apellidos'] = $this->input->post('apellidos');        
        $datosAcademico['telefono'] = $this->input->post('telefono');
        $datosAcademico['contrasena'] = $this->input->post('contrasena');


        if ($this->form_validation->run() === FALSE)
        {            
            redirect('ControladorEditarPerfil/index');            
        }
        else
        {
            $this->ModeloAcademico->editarAcademico($datosAcademico);
            redirect('ControladorPaginaPrincipal/index');           
        }
        }else{
        redirect('ControladorIniciarSesion/index');        
      } 
    }
} 