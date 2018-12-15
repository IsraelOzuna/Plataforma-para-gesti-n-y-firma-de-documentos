<?php
class SubirVideoController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Maestro_Model');
        $this->load->model('Video_Model');
        $this->load->helper('url_helper'); 
        if($this->session->userdata('correo') != ''){            
            $this->load->view('SubirVideo');
        }
        else
        {
            redirect('PaginaPrincipalController/index');
        }        
    }

    public function index()
    {               
    }

    public function registrarVideo(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nombre', 'nombre', 'required');
        $this->form_validation->set_rules('EE', 'EE', 'required');
        $this->form_validation->set_rules('tema', 'tema', 'required');    

        $datos = array();
        $datos['nombre'] = $this->input->post('nombre');
        $datos['experiencia'] = $this->input->post('EE');
        $datos['tema'] = $this->input->post('tema');        
        $datos['fecha'] = null;

        if ($this->form_validation->run() === FALSE)
        {
            redirect('SubirVideoController/index');
        }else
        {
            $this->Video_Model->registrarVid($datos);
            $archivo = 'video';
            $video['file_name'] = $datos['nombre'];
            $video['upload_path'] = 'C:/Users/iro19/Documents/7mo/Web/Practicas/CodeIgniter/videos/';
            $video['allowed_types'] = 'mp4';
            $video['max_size'] = '6000';

            $this->load->library('upload', $video);

            if ( ! $this->upload->do_upload($archivo)){
                $mensaje['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();
            }else{                      
                $mensaje['uploadSucces'] = $this->upload->display_errors();                    
            }
        }
    }     
}