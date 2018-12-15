<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ControladorCorreo extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');        
        $_SESSION['clave'] = "";
    }

    public function index()
    {        
    }

    public function enviarCorreo(){        
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
        $this->email->to("iro1904@hotmail.com");
        $this->email->subject('Confirmación de registro');
        $claveGenerada = mt_rand(1000,9999);        
        $this->email->message($claveGenerada);
        $this->email->send();
    }

    public function confirmarCorreo()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('claveConfirmacion','clave','required');

        $valor = $this->input->post('claveConfirmacion');

        echo $this->$_SESSION['clave'];

        if($this->form_validation->run() === FALSE )
        {
            echo "Campo Vacio";
        }
        else{           
           // Comparar si son las mismas claves
        } 
    }
}