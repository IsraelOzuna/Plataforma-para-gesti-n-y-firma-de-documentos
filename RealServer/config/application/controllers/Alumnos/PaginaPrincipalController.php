<?php
class PaginaPrincipalController extends CI_Controller{
	public function __construct()
    {        
        parent::__construct();
        $this->load->model('Maestro_Model');        
        $this->load->model('Video_Model');
        if($this->session->userdata('correo') != ''){            
            redirect('SubirVideoController/index');
        }            
    }

    public function index()
    { 
        $data = array();
        $data['results'] = array();
    	$data['results'] = $this->Video_Model->obtenerNombreVideos(); 
        $this->load->view('encabezado');            
        $this->load->view('PaginaVideos', $data);        
    }
}