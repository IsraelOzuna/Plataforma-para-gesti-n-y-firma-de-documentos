<?php
class ControladorPaginaPrincipal extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('ModeloAcademico');
        $this->load->model('ModeloDocumentos');
        $this->load->helper('url_helper');
    }

    public function index()
    { 
    	if($this->session->userdata('correo') != ''){       
            $this->load->helper('date');   
            $academico['nombre'] =  $this->session->userdata('nombre');
            $idAcademico['idAcademico'] = $this->session->userdata('idAcademico');
            $directorio = realpath(APPPATH) . '/archivos/' . $idAcademico['idAcademico'];

            if (!file_exists($directorio)) {
                mkdir($directorio, 0777, true);
            }  

              // Array en el que obtendremos los resultados
              $listaArchivos = array();
             
              // Agregamos la barra invertida al final en caso de que no exista
              if(substr($directorio, -1) != "/") $directorio .= "/";
             
              // Creamos un puntero al directorio y obtenemos el listado de archivos
              $dir = @dir($directorio) or die("getFileList: Error al abrir el directorio para leerlo");
              while(($archivo = $dir->read()) !== false) {

                  $extension = pathinfo($archivo, PATHINFO_EXTENSION);
                  
                  // Obviamos los archivos ocultos
                  if($archivo[0] == ".") continue;
                  if(is_dir($directorio . $archivo)) {
                    $time = filemtime($directorio . $archivo);
                      $listaArchivos[] = array(
                        "Nombre" => $archivo,
                        "Tam" => $this->formatoFileSize(filesize($directorio . $archivo)),
                        "Modificado" => unix_to_human($time),
                        "Extension" => $extension,
                        "idAcademico" => $idAcademico['idAcademico']
                      );
                  } else if (is_readable($directorio . $archivo)) {

                      $time = filemtime($directorio . $archivo);
                      $listaArchivos[] = array(
                        "Nombre" => $archivo,
                        "Tam" => $this->formatoFileSize(filesize($directorio . $archivo)),
                        "Modificado" => date('Y-M-d'),
                        "Extension" => $extension,
                        "idAcademico" => $idAcademico['idAcademico']
                      );
                  }
              }
              $dir->close();

              $data['listaArchivos'] = $listaArchivos;


            $this->load->view('Encabezado', $academico);
            $this->load->view('PaginaPrincipal', $data);
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

    public function abrirArchivo($nombreArchivo){
     $this->load->library('Pdf');
      $archivo = realpath(APPPATH) . '/archivos/' . $this->session->userdata('idAcademico') .'/' . urldecode($nombreArchivo);

      if(pathinfo($archivo, PATHINFO_EXTENSION) == 'pdf'){
        header('Content-type: application/pdf');
      }else{
        header('Content-type: text/html');
      }
      header('Content-Disposition: inline; filename="' . $nombreArchivo . '"');
      header('Content-Transfer-Encoding: binary');
      header('Content-Length: ' . filesize($archivo));
      header('Accept-Ranges: bytes');
        
      @readfile($archivo);
    }



    public function registrarArchivo(){                        
        $archivo = 'documento';
        $nombreArchivo= $_FILES[$archivo]["name"];	

        $idAcademico['idAcademico'] = $this->session->userdata('idAcademico');
        $directorio = realpath(APPPATH) . '/archivos/' . $idAcademico['idAcademico'];	

        $datos = array();       	
        $datos['titulo'] = $nombreArchivo;          	     	
        $datos['rutaDocumento'] = $directorio . '/' . $nombreArchivo; 
        $this->ModeloDocumentos->registrarDocumento($datos);       
 
        $documento['file_name'] = $datos['titulo'];
        $documento['upload_path'] = $directorio;
        $documento['allowed_types'] = 'pdf|doc|docx';
        $documento['max_size'] = '10000';


        $this->load->library('upload', $documento);
        if (! $this->upload->do_upload($archivo)){
            $mensaje['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
        }else{                      
            $mensaje['uploadSucces'] = $this->upload->display_errors();                    
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
                if(!$this->ModeloDocumentos->verificarDocumentoCompartidoExistente($sessionActual['idAcademico'], $data['nombreArchivo'])){
                  $academicoDestinatario =  $this->ModeloAcademico->obtenerDatos($data['correo']);
                  $datosArchivoCompatido = Array(
                    'idRemitente' => $sessionActual['idAcademico'],
                    'idDestinatario' => $academicoDestinatario[0]['idAcademico'],
                    'nombreArchivo'=> $data['nombreArchivo'],
                    'autor' => $sessionActual['nombre'],
                    'correo' => $sessionActual['correo']
                  );
                  if($this->ModeloDocumentos->registrarDocumentoCompartido($datosArchivoCompatido)){
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
}