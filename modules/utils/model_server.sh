#!/bin/bash

function create_model_server()
{
    api_path="../server/application/modules/"$modulo"/models"    
echo '<?php
include_once(APPPATH ."models/base_model.php");
Class '${modulo^}'_model extends Base_model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function get_'$modulo'()
    {
        $this->db->where("campo", 1);
        $this->db->from("tabla");
        $result = $this->db->get();
        return $result->result();
    }
}
?>'>$api_path/$modulo'_model.php'
}
