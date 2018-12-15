<?php
class FormularioController extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Alumno_Model');
        $this->load->helper('url_helper');
    }

    public function index()
    { 
    	if($this->session->userdata('matricula') != ''){  
    		$data['alumnos'] = $this->Alumno_Model->get_Alumnos();
    		$this->load->view('templates/header');
    		$this->load->view('alumnos/Pagina_Principal', $data);
    	}else{
    		redirect('IniciarSesionController/index');
    	}
    }
}