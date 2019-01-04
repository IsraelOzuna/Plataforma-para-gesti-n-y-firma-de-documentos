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
        if($this->session->userdata('correo') != ''){
            $correo = $this->session->userdata('correo');
            $mensajes['mensajes'] = $this->ModeloMensaje->obtenerMensajes($correo);
            $academico['nombre'] =  $this->session->userdata('nombre');
            $this->load->view('Encabezado', $academico);
            $this->load->view('VistaMensajes',$mensajes);
        }else{
            redirect('ControladorIniciarSesion/index');                 
        } 
    }

    public function enviarMensaje()
    {
        if($this->session->userdata('correo') != ''){
            $datos = $this->input->post();
            $informacion = array(
                'receptor' => $datos['receptor'],
                'mensaje' => $datos['mensaje'],
                'emisor' => $this->session->userdata('correo')
            );

            $this->ModeloMensaje->guardarMensaje($informacion);
        }else{
            redirect('ControladorIniciarSesion/index');                 
        }
    }

    public function enviarNuevoMensaje()
    {
        if($this->session->userdata('correo') != ''){
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
        }else{
            redirect('ControladorIniciarSesion/index');                 
        }
    }


    public function verificarCorreo($correo)
    {
        if($this->session->userdata('correo') != ''){
            $boolean = false;

            if($this->ModeloAcademico->verificarCorreoExistente($correo))
            {
                $boolean = true;
            }

            return $boolean;
        }else{
            redirect('ControladorIniciarSesion/index');                 
        }
    }   
}
