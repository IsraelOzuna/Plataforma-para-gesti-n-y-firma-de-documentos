<?php
class ControladorDocumentosCompartidos extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('ModeloDocumentos');
        $this->load->helper('url_helper');
        $this->load->helper('date'); 
    }

    public function index()
    { 
    	if($this->session->userdata('correo') != ''){              
        $academico['nombre'] =  $this->session->userdata('nombre');
        $idAcademico = $this->session->userdata('idAcademico');    
        $data['listaDocumentosPropios'] = $this->cargarDocumentosCompartidos();
        $this->load->view('Encabezado', $academico);
        $this->load->view('VistaDocumentosCompartidos', $data);
      }else{
       	redirect('ControladorIniciarSesion/index');        
      }    	
    }


    function cargarDocumentosCompartidos(){
        
      if($this->session->userdata('correo') != ''){

        $idAcademico = $this->session->userdata('idAcademico');
        $directorio = realpath(APPPATH) . '/archivos/' . $idAcademico;
        $documentosCompartidos = $this->ModeloDocumentos->getTodosDocumentosCompartidos($idAcademico);
        $listaDocumentosPropios = array();

        foreach ($documentosCompartidos as $documento) {

          if($documento['idRemitente'] != $idAcademico){

            $directorioRemitente = realpath(APPPATH) . '/archivos/' . $documento['idRemitente'];
            $archivo = $directorioRemitente . '/' . $documento['nombreArchivo'];
            if (file_exists($directorioRemitente) && file_exists($archivo)) {
              $time = filemtime($archivo);
              $listaDocumentosPropios[] = array(
                "nombreArchivo" => $documento['nombreArchivo'],
                "tam" => $this->formatoFileSize(filesize($archivo)),
                "modificado" => unix_to_human($time),
                "idRemitente" => $documento['idRemitente'],
                "autor" => $documento['autor'],
                "correo" => $documento['correo']
              );    
            }  
          }else{

            $archivo = $directorio . '/' . $documento['nombreArchivo'];
            if (file_exists($directorio) && file_exists($archivo)) {
              $time = filemtime($archivo);
              $listaDocumentosPropios[] = array(
              "nombreArchivo" => $documento['nombreArchivo'],
              "tam" => $this->formatoFileSize(filesize($archivo)),
              "modificado" => unix_to_human($time),
              "idRemitente" => $documento['idRemitente'],
              "autor" => $documento['autor'],
              "correo" => $documento['correo']
              ); 
            }  
          }
        }

      if (!empty($listaDocumentosPropios)) {
  echo '<script type="text/javascript">';
  echo "var listaphp = " . json_encode($listaDocumentosPropios) . "\n";
  echo '</script>';
}
      return $listaDocumentosPropios;

    }else{
      redirect('ControladorIniciarSesion/index');  
    }
  }

    public function abrirArchivo(){
      $datos = array();
      $datos = $this->input->post();
      //$datos['idRemitente'] = '55555';
      //$datos['nombreArchivo'] = 'PAGINA.pdf';
      $archivo = realpath(APPPATH) . '/archivos/' . $datos['idRemitente'] .'/' . $datos['nombreArchivo'];
      if(pathinfo($archivo, PATHINFO_EXTENSION) == 'pdf'){
        header('Content-type: application/octet-stream');
      }else{
        header('Content-type: text/html');
      }
      header('Content-Disposition: inline; filename="' . $datos['nombreArchivo'] . '"');
      header('Content-Transfer-Encoding: binary');
      header('Content-Length: ' . filesize($archivo));
      header('Accept-Ranges: bytes');
      //@readfile($archivo);
      echo @createfile($archivo);
      
    }



    function formatoFileSize($bytes) 
    { 
       if ($bytes >= 1073741824) 
       { 
          $bytes = number_format(($bytes)/1073741824, 2) . ' GB'; 
        } 
      elseif ($bytes >= 1048576) 
      { 
          $bytes = number_format($bytes/1048576, 2) . ' MB'; 
      } 
      elseif ($bytes >= 1024) 
      { 
          $bytes = number_format($bytes/1024, 2) . ' KB'; 
      } 
      elseif ($bytes > 1) 
      { 
          $bytes = $bytes . ' bytes'; 
      } 
      elseif ($bytes == 1) 
      { 
          $bytes = $bytes . ' byte'; 
      } 
      else 
      { 
          $bytes = '0 bytes'; 
      } 

      return $bytes; 
    } 




    
}