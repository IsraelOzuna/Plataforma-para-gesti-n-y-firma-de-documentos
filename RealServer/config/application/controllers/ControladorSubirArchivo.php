<?php
class ControladorSubirArchivo extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModeloAcademico');
        $this->load->model('Documento_Model');
        $this->load->helper('url_helper'); 
        if($this->session->userdata('correo') != ''){                             
            $this->load->view('SubirArchivo');
        }
        else
        {
            redirect('ControladorIniciarSesion/index');
        }        
    }

    public function index()
    {               
    }

    public function registrarArchivo(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nombre', 'nombre', 'required');        
        $this->form_validation->set_rules('tema', 'tema', 'required');    
        $this->form_validation->set_rules('fecha', 'fecha', 'required');
        $this->form_validation->set_rules('academia', 'academia', 'required');

        $datos = array();
        $datos['nombre'] = $this->input->post('nombre');
        $datos['tema'] = $this->input->post('tema');
        $datos['fecha'] = $this->input->post('fecha');        
        $datos['academia'] = $this->input->post('academia');  

        if ($this->form_validation->run() === FALSE)
        {
            redirect('ControladorSubirArchivo/index');
        }else
        {
            $this->Documento_Model->registrarDocumento($datos);
            $archivo = 'documento';
            $acta['file_name'] = $datos['nombre'];
            $acta['upload_path'] = 'C:/Users/iro19/Documents/7mo/Web/Practicas/CodeIgniter/Documentos';
            $acta['allowed_types'] = 'pdf';
            $acta['max_size'] = '6000';

            $this->load->library('upload', $acta);

            if ( ! $this->upload->do_upload($archivo)){
                $mensaje['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();
            }else{                      
                $mensaje['uploadSucces'] = $this->upload->display_errors();                    
            }
        }
    }     
}