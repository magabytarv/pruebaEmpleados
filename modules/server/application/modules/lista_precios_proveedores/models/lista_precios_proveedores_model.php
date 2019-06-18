<?php
include_once(APPPATH ."models/base_model.php");
Class Lista_precios_proveedores_model extends Base_model
{
    function __construct()
    {
        parent::__construct();
    }

    public function obtener_lista_precios_proveedo($codigo_proveedor) {
    	$this->connection_matriz();
    	$this->oConGeneral->where('codigo_proveedor', $codigo_proveedor);
    	$lista_precios = $this->oConGeneral->get('gi_lista_precios_proveedor')->result_array();
    	$this->oConGeneral->close();
    	return $lista_precios;
    }

    public function eliminar_lista_precios_proveedor($codigo_proveedor) {
    	$this->connection_matriz();
    	$this->oConGeneral->where('codigo_proveedor', $codigo_proveedor);
    	$this->oConGeneral->delete('gi_lista_precios_proveedor');
    	$this->oConGeneral->close();
    	return true;
    }

    public function guardar_lista_precios_proveedores($productos) {
    	$this->connection_matriz();
    	$this->oConGeneral->insert_batch('gi_lista_precios_proveedor', $productos);
    	$this->oConGeneral->close();
    	return true;
    }

    public function guardar_historial_lista_precios_proveedores($data_insert) {
    	$this->connection_matriz();
    	$this->oConGeneral->insert('gi_historial_lista_precios_proveedor', $data_insert);
    	$this->oConGeneral->close();
    	return true;
    }

    public function remplazar_lista_precios_proveedores($productos) {
    	foreach ($productos as $producto) {
	    	$this->connection_matriz();
	    	$this->oConGeneral->replace('gi_lista_precios_proveedor', $producto);
	    	$this->oConGeneral->close();
	    }
	    return true;
    }


    public function get_moneda_proveedor($proveedor) {
        $moneda = array("moneda" => "");
        $this->connection_matriz();
        $this->oConGeneral->select('codigo_moneda as moneda');
        $this->oConGeneral->where('codigo_proveedor',$proveedor);
        $datos = $this->oConGeneral->get('gi_lista_precios_proveedor')->result_array();
        if(count($datos) > 0) {
            $moneda = $datos[0];
        }
        return $moneda;
    }

    public function obtener_historial_precios_proveedo($codigo_proveedor, $fecha_desde = '', $fecha_hasta = '') {
        $this->connection_matriz();
        $this->oConGeneral->where('codigo_proveedor', $codigo_proveedor);
        if($fecha_desde != '' && $fecha_hasta != '') {
            $this->oConGeneral->where('fecha_carga >=', $fecha_desde . ' 00:00:00');
            $this->oConGeneral->where('fecha_carga <=', $fecha_hasta . ' 23:59:59');
        }
        $lista_precios = $this->oConGeneral->get('gi_historial_lista_precios_proveedor')->result_array();
        $this->oConGeneral->close();
        return $lista_precios;
    }
}
?>
