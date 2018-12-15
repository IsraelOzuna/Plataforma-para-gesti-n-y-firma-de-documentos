<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControladorEditor extends CI_Controller {

	public function index()
	{
		$academico['nombre'] =  $this->session->userdata('nombre') ;        
        $this->load->view('Encabezado', $academico);
		$this->load->view('Editor');
	}

	public function guardarDocumento()
	{
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

			$archivo = realpath(APPPATH) . '/archivos/' . $idAcademico['idAcademico']. '/'  .$datos['nombreArchivo'] .'.txt';

			if ( ! write_file($archivo, $datos['contenido']))
			{
	        	echo 'false';
			}
			else
			{
				$this->exportarPDF($datos['contenido'], $datos['nombreArchivo']);
	       		echo 'true';
			}
		}	
							
	}

	public function abrirDocumento($nombreArchivo)
	{

		$nombreArchivo = urldecode($nombreArchivo);
		$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
		$archivoSinExtemsion = substr($nombreArchivo, 0, -(strlen($extension)+1));
		$idAcademico['idAcademico'] =  $this->session->userdata('idAcademico') ; 
		$archivo = realpath(APPPATH) . '/archivos/' . $idAcademico['idAcademico']. '/'  . $nombreArchivo; 
		$datos['contenido'] = file_get_contents($archivo);
		$datos['nombreArchivo'] = $archivoSinExtemsion;

		$academico['nombre'] =  $this->session->userdata('nombre') ;        
        $this->load->view('Encabezado', $academico);
 		$this->load->view('Editor', $datos);


	}

	public function exportarPDF($contenido, $nombreArchivo){
		$this->load->library('Pdf');
		
		$archivo = realpath(APPPATH) . '/archivos/55555/' . $nombreArchivo.'.pdf';


		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('My Title');
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(20);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');

		$pdf->AddPage();
		$html = $contenido;

		//$pdf->Write(5, 'Some sample text');
		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);



		$pdf->Output($archivo, 'F');
	}
}
