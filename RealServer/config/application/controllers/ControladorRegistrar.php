<?php
class ControladorRegistrar extends CI_Controller {
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
            $this->load->view('VistaRegistrarAcademico');        
        }  
    }    

    public function registrarAcademico(){
        if($this->session->userdata('correo') != ''){            
            redirect('ControladorPaginaPrincipal/index');
        }else{        
            $datos = array();
            $datos = $this->input->post();
            if($this->ModeloAcademico->registrarAcademico($datos)){
                echo "registroExitoso";
            }else{
                echo "noRegistrado";

            } 
        }

        
    }

    public function enviarCorreo(){
        if($this->session->userdata('correo') != ''){            
            redirect('ControladorPaginaPrincipal/index');
        }else{
            $datos = array();
            $datos = $this->input->post();        
            if($this->ModeloAcademico->verificarCorreoExistente($datos['correo'])){
                echo "yaRegistrado";
            }else{
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
    } 
}