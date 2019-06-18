<?php
include_once(APPPATH ."models/base_model.php");
Class Empleados_model extends Base_model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function get_empleados()
    {
        $this->db->where("campo", 1);
        $this->db->from("tabla");
        $result = $this->db->get();
        return $result->result();
    }

    function obtener_empleados(){
        $this->db->from("EmpleadosPersonal");
        $result = $this->db->get();
        return $result->result();
    }

    function obtener_empleados_filtro($nombre,$codigo){
        $this->db->like("Nombres", $nombre);
        $this->db->or_like("Apellidos", $nombre);
        $this->db->or_like("Cedula", $codigo);
        $this->db->from("EmpleadosPersonal");
        $result = $this->db->get();
        //print_r($this->db->last_query());
        return $result->result();
    }

    function obtener_provincias(){
        $this->db->select("nombre_provincia");
        $this->db->from("Provincia");
        $result = $this->db->get();
        return $result->result();
    }

    function guardar_empleado($datos)    {
        $insert = $this->db->replace('EmpleadosPersonal', $datos);
        return $insert;
    }
}
?>
