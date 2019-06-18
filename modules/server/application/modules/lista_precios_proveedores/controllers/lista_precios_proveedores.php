<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class lista_precios_proveedores extends MX_Controller {

    function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$data["title_for_layout"] = "Lista Precios Proveedores";
		$data["angular_app"] = "Lista_precios_proveedores";
		$this->layout->view("lista_precios_proveedores", $data);
	}

	public function historial()
	{
		$data["title_for_layout"] = "Historial Precios Proveedores";
		$data["angular_app"] = "Lista_precios_proveedores";
		$this->layout->view("historial_precios_proveedores", $data);
	}
}

