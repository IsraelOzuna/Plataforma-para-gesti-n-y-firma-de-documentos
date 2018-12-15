<?php
class ModeloDocumentos extends CI_Model {

	public function __construct()
    { 
        
    }

    public function registrarDocumento($datosDocumento)
    {                
        return $this->db->insert('documento', $datosDocumento);
    }    

    #Documentos compartidos con el academico
    public function getDocumentosCompartidos($idDestinatario)
    {
    	$this->db->where('idDestinatario', $idDestinatario);        
        $documentosDestinatario = $this->db->get('documentoscompartidos'); 
    	return $documentosDestinatario->result_array();
    }

    #Documentos que el academico ha compartido con otros academicos
    public function getDocumentosCompartidosPropios($idRemitente)
    {
    	$this->db->where('idRemitente', $idRemitente);        
        $documentoRemitente = $this->db->get('documentoscompartidos'); 
    	return $documentoRemitente->result_array();
    }

    #Documentos que el academico ha compartido con otros academicos
    public function getTodosDocumentosCompartidos($idRemitente)
    {
        $this->db->where('idDestinatario', $idRemitente);  
        $this->db->or_where('idRemitente', $idRemitente); 
        $documentosCompartidos = $this->db->get('documentoscompartidos'); 
        return $documentosCompartidos->result_array();
    }

    public function registrarDocumentoCompartido($datosDocumentoCompartido){
        return $this->db->insert('documentoscompartidos', $datosDocumentoCompartido);
    }

    public function verificarDocumentoCompartidoExistente($idRemitente, $nombreArchivo){
        $this->db->where('idRemitente', $idRemitente);
        $this->db->where('nombreArchivo', $nombreArchivo);
        $documentoExistente = false;
        $resultado = $this->db->get('documentoscompartidos');
        if ($resultado->num_rows() > 0) {
            $documentoExistente = true;
        }
        return $documentoExistente;
    }
}