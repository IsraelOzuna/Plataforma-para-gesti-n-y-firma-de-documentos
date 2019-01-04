<?php
class ControladorDocumentosCompartidos extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('ModeloDocumento');
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
        $documentosCompartidos = $this->ModeloDocumento->getTodosDocumentosCompartidos($idAcademico);
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

      return $listaDocumentosPropios;

    }else{
      redirect('ControladorIniciarSesion/index');  
    }
  }

  
  public function abrirArchivo($id, $nombreArchivo){

    if($this->session->userdata('correo') != ''){    
      $idRemitente = base64_decode($id);
      $nombreArchivo = urldecode($nombreArchivo);
      $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
      $archivoSinExtension = substr($nombreArchivo, 0, -(strlen($extension)+1));
      $archivo = realpath(APPPATH) . '/archivos/' . $idRemitente .'/' . $archivoSinExtension . '.pdf';

      header('Content-type: application/pdf');
      header('Content-Disposition: inline; filename="' . $archivoSinExtension . '.pdf"');
      header('Content-Transfer-Encoding: binary');
      header('Content-Length: ' . filesize($archivo));
      header('Accept-Ranges: bytes');

      @readfile($archivo);
      }else{
        redirect('ControladorIniciarSesion/index');        
      } 
    }

    public function descargarPDF($correo, $nombreArchivo)
    {   
      if($this->session->userdata('correo') != ''){
        $this->load->helper('download');
        $correo = base64_decode(urldecode($correo));
        $nombreArchivo = base64_decode(urldecode($nombreArchivo));
        $documento =  $this->ModeloDocumento->getDocumentoCompartido($correo, $nombreArchivo); 
        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        $archivoSinExtension = substr($nombreArchivo, 0, -(strlen($extension)+1)); 
        $rutaArchivo = realpath(APPPATH) . '/archivos/' . $documento[0]['idRemitente'] . '/' . $archivoSinExtension . '.pdf';
        if (file_exists($rutaArchivo)){
          $contenido = file_get_contents($rutaArchivo); 
          $name = $archivoSinExtension . '.pdf';
          force_download($name, $contenido);
        }else{
          echo "Archivo no disponible";
        }
      }else{
        redirect('ControladorIniciarSesion/index');        
      } 
    }

      public function descargarWord($correo, $nombreArchivo)
      {
         if($this->session->userdata('correo') != ''){
        $this->load->helper('download');
        $correo = base64_decode(urldecode($correo));
        $nombreArchivo = base64_decode(urldecode($nombreArchivo));
        $documento =  $this->ModeloDocumento->getDocumentoCompartido($correo, $nombreArchivo); 
        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        $archivoSinExtension = substr($nombreArchivo, 0, -(strlen($extension)+1)); 
        $rutaArchivo = realpath(APPPATH) . '/archivos/' . $documento[0]['idRemitente'] . '/' . $archivoSinExtension . '.doc';
        if (file_exists($rutaArchivo)){
          $contenido = file_get_contents($rutaArchivo); 
          $name = $archivoSinExtension . '.doc';
          force_download($name, $contenido);
        }else{
          echo "Archivo no disponible";
        }
      }else{
        redirect('ControladorIniciarSesion/index');        
      } 
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