
<?php
class ControladorIniciarSesion extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModeloAcademico');
        $this->load->helper('url_helper');        
    }

    public function index()
    {       
        if($this->session->userdata('correo') != ''){            
            redirect('ControladorPaginaPrincipal/index');
        }else{
        	$this->load->view('IniciarSesion');        
        }        
    }       

    public function iniciar(){        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('correo', 'Correo', 'required');
        $this->form_validation->set_rules('contrasena', 'Contrasena', 'required');

        $correo = $this->input->post('correo');
        $contrasena = $this->input->post('contrasena');

        $academico = $this->ModeloAcademico->iniciarSesion($correo, $contrasena);
         if(count($academico)){
         	$datosAcademico = array(
         		'correo' => $academico[0]['correo'],
         		'idAcademico' => $academico[0]['idAcademico'],
         		'nombre' => $academico[0]['nombre']
         	);
         	 $this->session->set_userdata($datosAcademico); 

         	$directorio = realpath(APPPATH) . '/archivos/' . $datosAcademico['idAcademico'];

         	if(!file_exists($directorio)){
         		mkdir($directorio, 0777, true);
         	}
            redirect('ControladorPaginaPrincipal/index');                
        }else{
            redirect('ControladorIniciarSesion/index');                 
        }                    
    }

    public function cerrarSesion(){
        $this->session->sess_destroy();
        redirect('ControladorIniciarSesion/index'); 
    }   
}