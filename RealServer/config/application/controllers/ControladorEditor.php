<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControladorEditor extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('ModeloDocumento');
        $this->load->helper('url_helper');
    
    }

	public function index()
	{
		if($this->session->userdata('correo') != ''){  
			$academico['nombre'] =  $this->session->userdata('nombre') ;        
			$this->load->view('Encabezado', $academico);
			$this->load->view('VistaEditor');
		}else{
        	redirect('ControladorIniciarSesion/index'); 
    	}
	}

	public function guardarDocumento()
	{
		if($this->session->userdata('correo') != ''){  
			$datos = array();
			$datos = $this->input->post();

			if($datos['nombreArchivo'] == ""){
				echo 'sinNombre';
		}else{
			$this->load->helper('file');
			$idAcademico['idAcademico'] = $this->session->userdata('idAcademico');
			$directorio = realpath(APPPATH) . '/archivos/' . $idAcademico['idAcademico'];
			if (!file_exists($directorio))
			{
				mkdir($directorio, 0777, true);
			}

			$archivoTxt = realpath(APPPATH) . '/archivos/' . $idAcademico['idAcademico']. '/'  .$datos['nombreArchivo'] .'.txt';
			$archivoDoc = realpath(APPPATH) . '/archivos/' . $idAcademico['idAcademico']. '/'  .$datos['nombreArchivo'] .'.doc';

			if ( ! write_file($archivoTxt, $datos['contenido'])){
				echo 'false';
			}
			else{

				if ( ! write_file($archivoDoc, strip_tags($datos['contenido']))){
					echo 'false';
				}
				else{
					$this->exportarPDF($datos['contenido'], $datos['nombreArchivo'], $idAcademico['idAcademico']);
					echo 'true';
				}		
			}
		}
		}else{
        	redirect('ControladorIniciarSesion/index'); 
    	}	
	}

	public function abrirDocumento($nombreArchivo)
	{
		if($this->session->userdata('correo') != ''){  
		$nombreArchivo = base64_decode(urldecode($nombreArchivo));
		$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
		$archivoSinExtemsion = substr($nombreArchivo, 0, -(strlen($extension)+1));
		$idAcademico['idAcademico'] =  $this->session->userdata('idAcademico') ; 
		$archivo = realpath(APPPATH) . '/archivos/' . $idAcademico['idAcademico']. '/'  . $nombreArchivo; 
		$datos['contenido'] = file_get_contents($archivo);
		$datos['nombreArchivo'] = $archivoSinExtemsion;

		$academico['nombre'] =  $this->session->userdata('nombre') ;        
        $this->load->view('Encabezado', $academico);
 		$this->load->view('VistaEditor', $datos);
 		}else{
        redirect('ControladorIniciarSesion/index'); 
    	}

	}

	public function abrirDocumentoCompartido($correo, $nombreArchivo)
	{
		if($this->session->userdata('correo') != ''){  
		$correo = base64_decode(urldecode($correo));
       	$nombreArchivo = base64_decode(urldecode($nombreArchivo));
        $documento =  $this->ModeloDocumento->getDocumentoCompartido($correo, $nombreArchivo);

		$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
		$archivoSinExtemsion = substr($nombreArchivo, 0, -(strlen($extension)+1));
		$idAcademico['idAcademico'] =  $this->session->userdata('idAcademico') ; 
		$archivo = realpath(APPPATH) . '/archivos/' . $documento[0]['idRemitente'] . '/'  . $nombreArchivo; 
		$datos['contenido'] = file_get_contents($archivo);
		$datos['nombreArchivo'] = $archivoSinExtemsion;

		$academico['nombre'] =  $this->session->userdata('nombre') ;        
        $this->load->view('Encabezado', $academico);
 		$this->load->view('VistaEditor', $datos);
 		}else{
        redirect('ControladorIniciarSesion/index'); 
    	}

	}

	public function exportarPDF($contenido, $nombreArchivo, $idAcademico){
		if($this->session->userdata('correo') != ''){  
		$this->load->library('Pdf');
		
		$archivo = realpath(APPPATH) . '/archivos/' . $idAcademico .'/' . $nombreArchivo.'.pdf';

		$pdf = new Pdf('P', 'mm', 'letter', true, 'UTF-8', false);
		$pdf->SetTitle($nombreArchivo);
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(20);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor($this->session->userdata('nombre'));
		$pdf->SetDisplayMode('real', 'default');

		$pdf->AddPage();
		$html = $contenido;

		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

		$pdf->Output($archivo, 'F');
		}else{
        redirect('ControladorIniciarSesion/index'); 
    	}
	}
}
