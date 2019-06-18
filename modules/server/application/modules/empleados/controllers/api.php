<?php
defined("BASEPATH") OR exit("No direct script access allowed");

require APPPATH . "/libraries/REST_Controller.php";
 
class api extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("Empleados_model", "empleados");
    }
 
    function empleados_get()
    {
        // respond with information about a empleados
        // return data = echo format_response($data);
    }
 
    function empleados_put()
    {
        // create a new empleados and respond with a status/errors
        // return data = echo format_response($data);
    }
 
    function empleados_post()
    {
        // update an existing empleados and respond with a status/errors
        // return data = echo format_response($data);
    }
 
    function empleados_delete()
    {
        // delete a empleados and respond with a status/errors
        // return data = echo format_response($data);
    }
    
    function obtener_empleados_get(){
        $data = $this->empleados->obtener_empleados();
        $this->db->limit(20);
        echo format_response($data);
    }

    function obtener_empleados_filtro_get($nombre,$codigo){
        $data = $this->empleados->obtener_empleados_filtro($nombre,$codigo);
        echo format_response($data);
    }

    function obtener_provincias_get(){
        $data = $this->empleados->obtener_provincias();
        echo format_response($data);
    }

    function guardar_empleado_post(){
        $datos = $this->post();
        $datos_empleado['Nombres'] = $datos['nombres_empleado'];
        $datos_empleado['Apellidos'] = $datos['apellidos_empleado'];
        $datos_empleado['Cedula'] = $datos['cedula_empleado'];
        $datos_empleado['Provincia'] = $datos['provincia_empleado'];
        $datos_empleado['FechaNacimiento'] = $datos['fecha_nacimiento_empleado'];
        $datos_empleado['Email'] = $datos['email_empleado'];
        $datos_empleado['Observacion'] = $datos['observacion_personal'];
        $datos_empleado['FechaIngreso'] = $datos['fecha_ingreso_empleado'];
        $datos_empleado['Cargo'] = $datos['cargo_empleado'];
        $datos_empleado['Departamento'] = $datos['departamento_empleado'];
        $datos_empleado['ProvinciaLaboral'] = $datos['provincia_empleado_laboral'];
        $datos_empleado['Sueldo'] = $datos['sueldo_empleado'];
        $datos_empleado['JornadaParcial'] = 'NO';
        $datos_empleado['ObservacionLaboral'] = $datos['observacion_laboral'];
        $data = $this->empleados-guardar_empleado($datos);
        echo format_response($data);
    }
}
?>
