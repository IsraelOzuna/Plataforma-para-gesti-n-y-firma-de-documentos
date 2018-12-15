<?php
class PaginaPrincipalController extends CI_Controller{
	public function __construct()
    {        
        parent::__construct();
        $this->load->model('Academico_Model');        
        $this->load->model('Documento_Model');                
    }

    public function index()
    {         
        if($this->session->userdata('correo') != ''){ 
            $usuario = $this->session->userdata('correo');            
            $data['documentos'] = array();
            $data['documentos'] = $this->Documento_Model->obtenerDocumentos($usuario); 
            $this->load->view('templates/header');
            $this->load->view('PaginaPrincipal', $data);                                               
        }else{
            redirect('IniciarSesionController/index');                                     
        }
                
    }
}