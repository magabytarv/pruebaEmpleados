<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once('../json/jsonwrapper.php');

class Update_databases extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Update_database_model','Data_base');
    }

    function index()
    {
        echo $this->Data_base->execute_script_all_databases();
    }

}
