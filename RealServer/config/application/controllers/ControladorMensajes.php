<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControladorMensajes extends CI_Controller {

	 public function __construct()
        {
                parent::__construct();
                $this->load->model('ModeloMensaje');
                $this->load->model('ModeloAcademico');
                $this->load->helper('url_helper');
        }


		public function index()
	{
        $correo = $this->session->userdata('correo');
        $mensajes['mensajes'] = $this->ModeloMensaje->obtenerMensajes($correo);
        $academico['nombre'] =  $this->session->userdata('nombre');
        $this->load->view('Encabezado', $academico);
        $this->load->view('VistaMensajes',$mensajes);
    }
    
    public function enviarMensaje()
    {
        $datos = $this->input->post();
        $informacion = array(
            'receptor' => $datos['receptor'],
            'mensaje' => $datos['mensaje'],
            'emisor' => $this->session->userdata('correo')
        );
       
        $this->ModeloMensaje->guardarMensaje($informacion);
    }

    public function enviarNuevoMensaje()
    {
        $datos = $this->input->post();
        $informacion = array(
            'receptor' => $datos['receptor'],
            'mensaje' => $datos['mensaje'],
            'emisor' => $this->session->userdata('correo')
        );
       
        if($this->verificarCorreo($datos['receptor']))
        {
            $this->ModeloMensaje->guardarMensaje($informacion);
            echo "guardado";
        }else{
            echo "noExiste";
        }
    }


    public function verificarCorreo($correo)
    {
        $boolean = false;

        if($this->ModeloAcademico->verificarCorreoExistente($correo))
        {
            $boolean = true;
        }

        return $boolean;
    }

}
