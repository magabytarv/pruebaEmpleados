#!/bin/bash

function create_api_server()
{
    api_path="../server/application/modules/"$modulo"/controllers"
    get=$modulo"_get";
    post=$modulo"_post";
    put=$modulo"_put";
    delete=$modulo"_delete";
echo '<?php
defined("BASEPATH") OR exit("No direct script access allowed");

require APPPATH . "/libraries/REST_Controller.php";
 
class api extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("'${modulo^}'_model", "'$modulo'");
    }
 
    function '$get'()
    {
        // respond with information about a '$modulo'
        // return data = echo format_response($data);
    }
 
    function '$put'()
    {
        // create a new '$modulo' and respond with a status/errors
        // return data = echo format_response($data);
    }
 
    function '$post'()
    {
        // update an existing '$modulo' and respond with a status/errors
        // return data = echo format_response($data);
    }
 
    function '$delete'()
    {
        // delete a '$modulo' and respond with a status/errors
        // return data = echo format_response($data);
    }
}
?>'>$api_path/api.php
}
