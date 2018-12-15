<?php
class ControladorRegistrar extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModeloAcademico');
        $this->load->model('ModeloLlaves');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        if($this->session->userdata('correo') != ''){            
            redirect('ControladorPaginaPrincipal/index');
        }else{
            $this->load->view('RegistrarAcademico');        
        }  
    }    

    public function registrarAcademico()
    {        
 
        $datos = array();
        $datos = $this->input->post();          
        $this->generarLlaves($datos['correo']);
        $this->ModeloAcademico->registrarAcademico($datos);        
    }

    public function generarLlaves($correo){
        $nuevaLlave = openssl_pkey_new();

        //Obtener llave privada
        openssl_pkey_export($nuevaLlave, $llavePrivada);

        //Obtener llave publica
        $llavePublica = openssl_pkey_get_details($nuevaLlave);
        $llavePublica = $llavePublica["key"];

        $this->ModeloLlaves->registrarLlaves($correo,$llavePublica,$llavePrivada);            
    }

    public function enviarCorreo(){ 
        $datos = array();
        $datos = $this->input->post();        
          
        $this->load->library("email");
        $configGmail = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'gestordocumentosfei@gmail.com',
            'smtp_pass' => 'gestordocumentos',
            'mailtype' => 'html',
            'charset' => 'utf-8',  
            'newline' => "\r\n"
        );

        $this->email->initialize($configGmail);
        $this->email->from('GestorDocumentos');
        $this->email->to($datos['correo']);
        $this->email->subject('Confirmación de registro');            
        $this->email->message($datos['claveGenerada']);
        $this->email->send();
    }    
}