#!/bin/bash

function create_controller_server()
{
    api_path="../server/application/modules/"$modulo"/controllers"    
echo '<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class '$modulo' extends MX_Controller {

    function __construct()
    {
        parent::__construct();
    }
    
	public function index()
	{
		$data["title_for_layout"] = "'${modulo^}'";
		$data["angular_app"] = "'${modulo^}'";
		$this->layout->view("'$modulo'", $data);
	}
}
'>$api_path/$modulo'.php'
}
