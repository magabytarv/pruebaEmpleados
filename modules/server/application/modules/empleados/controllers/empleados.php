<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class empleados extends MX_Controller {

    function __construct()
    {
        parent::__construct();
    }
    
	public function index()
	{
		$data["title_for_layout"] = "Empleados";
		$data["angular_app"] = "Empleados";
		$this->layout->view("empleados", $data);
	}
}

