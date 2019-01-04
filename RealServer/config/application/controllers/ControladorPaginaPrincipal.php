<?php
class ControladorPaginaPrincipal extends CI_Controller{
	public function __construct()
  {
    parent::__construct();
    $this->load->model('ModeloAcademico');
    $this->load->model('ModeloDocumento');
    $this->load->helper('url_helper');
  }

  public function index()
  { 
    if($this->session->userdata('correo') != ''){ 
      $this->cargarPaginaPrincipal();
    }else{
      redirect('ControladorIniciarSesion/index');        
    }        
  }

  function cargarPaginaPrincipal(){
    if($this->session->userdata('correo') != ''){       
      $this->load->helper('date');   
      $academico['nombre'] =  $this->session->userdata('nombre');
      $idAcademico['idAcademico'] = $this->session->userdata('idAcademico');
      $directorioArchivosPropios = realpath(APPPATH) . '/archivos/' . $idAcademico['idAcademico'];
      $directorioCargados = realpath(APPPATH) . '/archivos/' . $idAcademico['idAcademico'] . '/ArchivosCargados';

      if (!file_exists($directorioArchivosPropios)) {
        mkdir($directorioArchivosPropios, 0777, true);
      }
      if (!file_exists($directorioCargados)) {
        mkdir($directorioCargados, 0777, true);
      }    

      $data['listaArchivos'] = $this->obtenerListaArchivos($directorioArchivosPropios, $idAcademico, "propio");
      $data['listaArchivosCargados'] = $this->obtenerListaArchivos($directorioCargados, $idAcademico, "cargado");

      $this->load->view('Encabezado', $academico);
      $this->load->view('VistaPaginaPrincipal', $data);
    }else{
     redirect('ControladorIniciarSesion/index');        
   }      
 }

 function obtenerListaArchivos($directorio, $idAcademico, $tipo){
  if($this->session->userdata('correo') != ''){   
    $listaArchivos = array();
    if(substr($directorio, -1) != "/") $directorio .= "/";


    $dir = @dir($directorio) or die("getFileList: Error al abrir el directorio para leerlo");
    while(($archivo = $dir->read()) !== false) {

      $extension = pathinfo($archivo, PATHINFO_EXTENSION);

      if(($extension == "txt" && $tipo == "propio") || ($tipo == "cargado" && $extension == "pdf")){

        if($archivo[0] == ".") continue;
        if(is_dir($directorio . $archivo)) {
          $time = filemtime($directorio . $archivo);
          $listaArchivos[] = array(
            "Nombre" => $archivo,
            "Tam" => $this->formatoFileSize(filesize($directorio . $archivo)),
            "Modificado" => unix_to_human($time),
            "idAcademico" => $idAcademico['idAcademico']
          );
        } else if (is_readable($directorio . $archivo)) {

          $time = filemtime($directorio . $archivo);
          $listaArchivos[] = array(
            "Nombre" => $archivo,
            "Tam" => $this->formatoFileSize(filesize($directorio . $archivo)),
            "Modificado" => date('Y-M-d'),
            "idAcademico" => $idAcademico['idAcademico']
          );
        }
      }

    }
    $dir->close();
    return $listaArchivos;
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

public function abrirArchivoCargado($nombreArchivo){
  if($this->session->userdata('correo') != ''){     
    $nombreArchivo = urldecode($nombreArchivo);
    $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    $archivoSinExtension = substr($nombreArchivo, 0, -(strlen($extension)+1));

    $archivo = realpath(APPPATH) . '/archivos/' . $this->session->userdata('idAcademico') .'/ArchivosCargados/' . $archivoSinExtension . '.pdf';

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

public function abrirArchivo($nombreArchivo){
  if($this->session->userdata('correo') != ''){     
    $nombreArchivo = urldecode($nombreArchivo);
    $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    $archivoSinExtension = substr($nombreArchivo, 0, -(strlen($extension)+1));

    $archivo = realpath(APPPATH) . '/archivos/' . $this->session->userdata('idAcademico') .'/' . $archivoSinExtension . '.pdf';

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



public function registrarArchivo(){    
  if($this->session->userdata('correo') != ''){                          
    $archivo = 'documento';
    $nombreArchivo= $_FILES[$archivo]["name"];	

    $idAcademico['idAcademico'] = $this->session->userdata('idAcademico');
    $directorio = realpath(APPPATH) . '/archivos/' . $idAcademico['idAcademico'] . '/ArchivosCargados';	

    $datos = array();       	
    $datos['titulo'] = $nombreArchivo;          	     	
    $datos['rutaDocumento'] = $directorio . '/' . $nombreArchivo;       

    $documento['file_name'] = $datos['titulo'];
    $documento['upload_path'] = $directorio;
    $documento['allowed_types'] = 'pdf';
    $documento['max_size'] = '10000';


    $this->load->library('upload', $documento);
    if (! $this->upload->do_upload($archivo)){
      $mensaje['uploadError'] = $this->upload->display_errors();
      echo $this->upload->display_errors();
    }else{                      
      $mensaje['uploadSucces'] = $this->upload->display_errors(); 
      redirect('ControladorPaginaPrincipal/index');                   
    }
  }else{
    redirect('ControladorIniciarSesion/index');        
  }  
}

public function descargarPDF($nombreArchivo, $tipo)
{   
  if($this->session->userdata('correo') != ''){  
    $this->load->helper('download');
    $tipo = base64_decode(urldecode($tipo));
    $nombreArchivo = base64_decode(urldecode($nombreArchivo));
    $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    $archivoSinExtension = substr($nombreArchivo, 0, -(strlen($extension)+1));
    $idAcademico['idAcademico'] = $this->session->userdata('idAcademico');
    if($tipo == "cargado"){
      $rutaArchivo = realpath(APPPATH) . '/archivos/' . $idAcademico['idAcademico'] . '/ArchivosCargados/' . $archivoSinExtension . '.pdf';
    }else{
      $rutaArchivo = realpath(APPPATH) . '/archivos/' . $idAcademico['idAcademico'] . '/' . $archivoSinExtension . '.pdf';
    }

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

public function descargarWord($nombreArchivo)
{
 if($this->session->userdata('correo') != ''){  
   $this->load->helper('download');
   $nombreArchivo = base64_decode(urldecode($nombreArchivo));
   $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
   $archivoSinExtension = substr($nombreArchivo, 0, -(strlen($extension)+1));
   $idAcademico['idAcademico'] = $this->session->userdata('idAcademico');
   $rutaArchivo = realpath(APPPATH) . '/archivos/' . $idAcademico['idAcademico'] . '/' . $archivoSinExtension . '.doc';
   if (file_exists($rutaArchivo)){
    $contenido = file_get_contents($rutaArchivo); 
    $name = $archivoSinExtension . '.doc';
    force_download($name, $contenido);
  }else{
    echo "Archivo no disponible";
  }
}
}


public function compartirArchivo(){

  if($this->session->userdata('correo') != ''){
    $this->load->model('ModeloAcademico');    
    $sessionActual = $this->session->userdata();  
    $data = array();
    $data = $this->input->post();
    if(!($data['correo'] == "" || $data['nombreArchivo'] == "")){ 
      if(!($data['correo'] == $sessionActual['correo'])){
        if($this->ModeloAcademico->verificarCorreoExistente($data['correo'])){
          $directorio = realpath(APPPATH) . '/archivos/' . $sessionActual['idAcademico'];
          $archivo = $directorio . '/' . $data['nombreArchivo'];
          if (file_exists($directorio) && file_exists($archivo)){
            if(!$this->ModeloDocumento->verificarDocumentoCompartidoExistente($sessionActual['idAcademico'], $data['nombreArchivo'])){
              $academicoDestinatario =  $this->ModeloAcademico->obtenerDatosAcademico($data['correo']);
              $datosArchivoCompatido = Array(
                'idRemitente' => $sessionActual['idAcademico'],
                'idDestinatario' => $academicoDestinatario[0]['idAcademico'],
                'nombreArchivo'=> $data['nombreArchivo'],
                'autor' => $sessionActual['nombre'],
                'correo' => $sessionActual['correo']
              );
              if($this->ModeloDocumento->registrarDocumentoCompartido($datosArchivoCompatido)){
                echo "Documento compartido exitosamente";
              }else{
                echo "Error al compartir: Intente de nuevo";
              }
            }else{
              echo "Ya has compartido el documento con ese destinatario";
            }
          }else{
            echo "El archivo que intentas compartir no esta disponible";
          }
        }else{
          echo "El correo ingresado es inválido";
        }
      }else{
        echo "No puedes compartir un documento a ti mismo";
      }
    }else{
      echo "Es necesaria una dirección de correo válida";
    }  

  }else{
    redirect('ControladorIniciarSesion/index');        
  }  
}




public function firmarPDF(){
  if($this->session->userdata('correo') != ''){  
    $data = array();
    $data = $this->input->post();
    $nombreArchivo = $data['nombreArchivo'];
    $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    $archivoSinExtension = substr($nombreArchivo, 0, -(strlen($extension)+1));
    $academico = $this->session->userdata();  

    if($nombreArchivo == ""){
      echo 'sinNombre';
    }else{
      $this->load->helper('file');

      $directorio = realpath(APPPATH) . '/archivos/' . $academico['idAcademico'];
      if (!file_exists($directorio))
      {
        mkdir($directorio, 0777, true);
      }

      $archivoTxt = realpath(APPPATH) . '/archivos/' . $academico['idAcademico']. '/'  .$nombreArchivo;

      if(!file_exists($archivoTxt)){
        echo 'archivoNoExiste';
      }else{
        $contenido = file_get_contents($archivoTxt);
        $this->load->library('Pdf');

        $pdf = new Pdf('P', 'mm', 'letter', true, 'UTF-8', false);
        $pdf->SetTitle($archivoSinExtension);
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($academico['nombre']);
        $pdf->SetDisplayMode('real', 'default');
        $pdf->AddPage();
        $info = array(
          'Name' => $academico['nombre'],
          'Location' => 'MX',
          'Reason' => 'Proyecto Desarrollo Web',
          'ContactInfo' => $academico['correo']
        );


        $pathCertificado = 'file://'. realpath(APPPATH) . '/archivos/' . $academico['idAcademico'] . '/' . $academico['idAcademico'] . '.cer';
        $pathKeyPrivate = 'file://'. realpath(APPPATH) . '/archivos/' . $academico['idAcademico'] . '/' . $academico['idAcademico'] . '.pem';
        $pathIconoFirma = realpath(APPPATH) . '/imagenes/firma2.png';
        $keyPrivada = file_get_contents($pathKeyPrivate);

        $pdf->Image($pathIconoFirma, 180, 60, 15, 15, 'PNG');

        $pdf->setSignature($pathCertificado, $keyPrivada, $academico['correo'], '', 0, $info, 'A');

        $pdf->writeHTML($contenido, true, 0, true, 0);

        $pdf->setSignatureAppearance(180, 60, 15, 15);

        $pdf->addEmptySignatureAppearance(180, 80, 15, 15);

        $pathGuardarArchivo = realpath(APPPATH) . '/archivos/' . $academico['idAcademico'] . '/' . $archivoSinExtension . '.pdf';
        $pdf->Output($pathGuardarArchivo, 'F');

        echo "firmaExitosa";
      }

    }

    }else{
      redirect('ControladorIniciarSesion/index');        
    }  
  }
}