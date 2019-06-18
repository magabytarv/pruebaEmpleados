<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Comun
{
    function __construct()
    {

    }

    public function parce_json_to_array()
    {
        $content_type_args = explode(';', $_SERVER['CONTENT_TYPE']); //parse content_type string
        if ($content_type_args[0] == 'application/json') {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }
        $_POST = $this->object_to_array_recursive($_POST);
    }
    public function objectToArray($d)
    {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return array_map(null, $d);
        } else {
            // Return array
            return $d;
        }
        return;
    }

    public function object_to_array_recursive($d)
    {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            // echo $this->algo('1');
            //echo var_dump(array_map(array($this, __FUNCTION__),$d));
            //return array_map(array_map($this->objectToArray($d),$d);
            return array_map(array($this, __FUNCTION__), $d);
        } else {
            // Return array
            return $d;
        }
        return;
    }

    public function enviar_correo($destino,$titulo,$subject,$mensaje)
    {
     /*   $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'autorizacionuribe@gmail.com',
            'smtp_pass' => 'pruebauribe',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );*/

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'eset.ecu@gmail.com',
            'smtp_pass' => 'eset!@#ABC',
            'mailtype' => 'html',
            'wordwrap'=> TRUE,
            'charset' => 'utf-8'
        );

        $CI =& get_instance();
        $CI->load->library('email', $config);
        $CI->email->set_newline("\r\n");
        $CI->email->from('eset.ecu@gmail.com',$titulo);
        $CI->email->to($destino);
        $CI->email->subject($subject);
        $CI->email->message($mensaje);
        $CI->email->send();
    }

    public function generatePassword($length = 8) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }
}