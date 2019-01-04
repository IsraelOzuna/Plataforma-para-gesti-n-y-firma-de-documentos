<?php
class ModeloDocumento extends CI_Model {

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

    public function getDocumentoCompartido($correo, $nombreArchivo){
        $this->db->where('correo', $correo);
        $this->db->where('nombreArchivo', $nombreArchivo);
        $documento = $this->db->get('documentoscompartidos'); 
        return $documento->result_array();
    }
}