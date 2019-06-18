<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('format_response'))
{
    function format_response($response = array(), $error = array())
    {
        
        $result = '{"response": '. json_encode($response) .', "errors": '. json_encode($error) .'}';
        
        return $result;
    }
}


if ( ! function_exists('parce_json_to_array'))
{
    function parce_json_to_array()
    {
        $content_type_args = explode(';', $_SERVER['CONTENT_TYPE']); //parse content_type string
        if ($content_type_args[0] == 'application/json') {
            $_POST = json_decode(file_get_contents('php://input'), true);
        }
        $_POST = $this->object_to_array_recursive($_POST);
    }
}

if ( ! function_exists('object_to_array_recursive'))
{
    function object_to_array_recursive($d)
    {
        if (is_object($d)) {
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            return array_map(array($this, __FUNCTION__), $d);
        }
        else {
            return $d;
        }
        
        return;
    }
}

if (!function_exists('split_dsn')) {
    function split_dsn($DSN, $key_to_extract)
    {
        $iPosi = strpos(strtolower($DSN), $key_to_extract);
        $iPosi = strpos(strtolower($DSN), '=', $iPosi) + 1;
        $iPosf = strpos(strtolower($DSN), ';', $iPosi);
        $key_to_extract = substr($DSN, $iPosi, $iPosf - $iPosi);
        return $key_to_extract;
    }
}
