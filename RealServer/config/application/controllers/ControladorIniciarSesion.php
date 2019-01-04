<?php
class ControladorIniciarSesion extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModeloAcademico');
        $this->load->helper('url_helper');        
    }

    public function index()
    {       
        if($this->session->userdata('correo') != ''){            
            redirect('ControladorPaginaPrincipal/index');
        }else{
        	$this->load->view('VistaIniciarSesion');        
        }        
    }       

    public function iniciar(){        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('correo', 'Correo', 'required');
        $this->form_validation->set_rules('contrasena', 'Contrasena', 'required');

        $correo = $this->input->post('correo');
        $contrasena = $this->input->post('contrasena');

        $academico = $this->ModeloAcademico->iniciarSesion($correo, $contrasena);
         if(count($academico)){
         	$datosAcademico = array(
         		'correo' => $academico[0]['correo'],
         		'idAcademico' => $academico[0]['idAcademico'],
         		'nombre' => $academico[0]['nombre']
         	);
         	$this->session->set_userdata($datosAcademico); 

         	$directorio = realpath(APPPATH) . '/archivos/' . $datosAcademico['idAcademico'];

         	if(!file_exists($directorio)){
         		mkdir($directorio, 0777, true);
         	}

            $pathCertificado = realpath(APPPATH) . '/archivos/' . $datosAcademico['idAcademico'] . '/' . $datosAcademico['idAcademico'] . '.cer';
            $pathLlavePrivada = $pathCertificado = realpath(APPPATH) . '/archivos/' . $datosAcademico['idAcademico'] . '/' . $datosAcademico['idAcademico'] . '.pem';
        

            if(!(file_exists($pathCertificado) || file_exists($pathLlavePrivada))){

               $dn = array(
                "countryName" => "MX",
                "stateOrProvinceName" => "Veracruz",
                "localityName" => "Xalapa",
                "organizationName" => "Universidad Veracruzana",
                "organizationalUnitName" => "LIS",
                "commonName" => $datosAcademico['nombre'] . " ".$academico[0]['apellidos'],
                "emailAddress" => $datosAcademico['correo']
                );

               $this->crearCertificado($dn, $datosAcademico['correo'], $datosAcademico['idAcademico']);             
            }
            
            redirect('ControladorPaginaPrincipal/index');                
        }else{
            redirect('ControladorIniciarSesion/index');                 
        }                    
    }


    static function crearCertificado($dn, $contrasena, $idAcademico){

        $duration = 365;

        $password = $contrasena;

        $vaultPath = realpath(APPPATH) . '/archivos/' . $idAcademico;

        $fileNameNoExtension = $idAcademico;
        $configFile = null;

        
        $configParams = null;
        if ($configFile)
            $configParams = array('config' => $configFile);
        
        $privkey = openssl_pkey_new($configParams);
        if ($privkey === FALSE){
            return FALSE;
        }

        $csr = openssl_csr_new($dn, $privkey, $configParams);
        if ($csr === FALSE){
            return FALSE;
        }
        $sscert = openssl_csr_sign($csr, null, $privkey, $duration, $configParams);
        if ($sscert === FALSE){
            return FALSE;
        }
        openssl_x509_export($sscert, $certout); 
        openssl_pkey_export($privkey, $pkout, $contrasena, $configParams);

        $file = $vaultPath.'/'.$fileNameNoExtension;

        file_put_contents($file.".cer", $certout);
        file_put_contents($file.".pem", $pkout);
        
        $result = array('cer'=>$certout, 'pem'=>$pkout, 'file'=>$file);
    
        return TRUE;
    }

    public function enviarCorreo(){ 
        $datos = array();
        $datos = $this->input->post(); 
        $correoExistente = $this->ModeloAcademico->verificarCorreoExistente($datos['correo']);

        if($correoExistente == true){
            $this->load->library("email");
            $configGmail = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port' => 465,
                'smtp_user' => 'gestordocumentosfei@gmail.com',
                'smtp_pass' => 'gestordocumentos',
                'mailtype' => 'html',
                'charset' => 'utf-8',  
                'newline' => "\r\n"
            );

            $this->email->initialize($configGmail);
            $this->email->from('GestorDocumentos');
            $this->email->to($datos['correo']);
            $this->email->subject('Recuperación de contraseña');            
            $this->email->message('Tu nueva contrasena es: ' . $datos['nuevaContrasena'] . ' Te sugerimos ingresar a tu perfil y cambiarla por una que recuerdes');
            $this->email->send();
            $this->ModeloAcademico->cambiarContrasena($datos);
        }else{
            echo "correoNoExiste";
        }                        
    }

    public function cerrarSesion(){
        $this->session->sess_destroy();
        redirect('ControladorIniciarSesion/index'); 
    }   
}