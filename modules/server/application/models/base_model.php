<?php
error_reporting(0);

Class Base_model extends CI_Model {
    protected $oConnB;
    protected $oConn;
    protected $oConGeneral;

    function __construct() {
        parent::__construct();
    }

    private function get_directory() {

        $this->db->select('codtab, ad7tab');
        $this->db->where("numtab = '97' AND codtab != ''");
        return $this->db->get('maetab');
    }

    private function get_matrix_connection($IDB = '01') {
        $this->connection_matriz();
        $this->oConGeneral->select('codtab, ad7tab');
        $this->oConGeneral->where("numtab = '97' AND codtab = '".$IDB."' ");
        return $this->oConGeneral->get('maetab');
    }

    public function get_warehouse_name($DSN) {
        $data = explode(';', $DSN);
        $warehouseData = explode('=', $data[2]);
        return $warehouseData[1];
    }

    public function get_matrix_name() {
        $matrix = $this->get_matrix_connection()->result_array();
        $dsn_matrix = $this->get_warehouse_name($matrix[0]['ad7tab']);

        return $dsn_matrix;
    }

    private function get_bodega_costos_connection() {

        $this->db->select('codtab, ad7tab');
        $this->db->where("numtab = '97' AND ad8tab = 'BMP' ");
        return $this->db->get('maetab');
    }

    public function get_bodega_costos_name() {
        $bod_costos = $this->get_bodega_costos_connection()->result_array();
        $dsn_bod_costos = $this->get_warehouse_name($bod_costos[0]['ad7tab']);
        return $dsn_bod_costos;
    }

    public function get_bodega_name($IDB = '01') {
        $bodega = $this->get_matrix_connection($IDB)->result_array();
        $name_bodega = $this->get_warehouse_name($bodega[0]['ad7tab']);

        return $name_bodega;
    }

    public function connection_matriz()
    {
        $this->oConGeneral = $this->load->database("oConGeneral", TRUE);
        if (!$this->oConGeneral->initialize()) {
            exit('NO ES POSIBLE CONECTARSE A LA BASE DE DATOS [oConGeneral]');
        }
    }

    public function connection_bodega()
    {
        $this->oConnB = $this->load->database("oConnB", TRUE);
        if (!$this->oConnB->initialize()) {
            exit('NO ES POSIBLE CONECTARSE A LA BASE DE DATOS [oConnB]');
        }
    }

    public function connection_infosac()
    {
        $this->oConn = $this->load->database("oConn", TRUE);
        if (!$this->oConn->initialize()) {
            exit('NO ES POSIBLE CONECTARSE A LA BASE DE DATOS [oConn]');
        }
    }

    public function round_up($number, $precision = 2) {
        $value = round($number, 3);
        $decimals = substr($value, strlen($value)-1, strlen($value));
        if(floatval($decimals) == 5) {
            $value = $value + 0.001;
        }
        return sprintf("%01." . $precision ."f", $value);
    }

    public function get_informacion_bodegas($principal) {
        $this->connection_matriz();
        $this->oConGeneral->select('nomtab as nombre_bodega, codtab as codigo, ad7tab as dsn');
        $this->oConGeneral->where('numtab', '97');
        $this->oConGeneral->where('codtab !=', '');
        if ($principal) {
            $this->oConGeneral->where("ifnull(ad0tab, '') !=", 'X');
        }
        $bodegas = $this->oConGeneral->get('maetab')->result_array();
        return $bodegas;
    }

    public function get_informacion_bodega($codigo = '01') {
        $this->connection_matriz();
        $this->oConGeneral->select('nomtab as nombre_bodega, codtab as codigo, ad7tab as dsn');
        $this->oConGeneral->where('numtab', '97');
        $this->oConGeneral->where("codtab", $codigo);
        $bodega = $this->oConGeneral->get('maetab')->row_array();
        return $bodega;
    }

    public function get_dsn_bodega($DSN) {
        $data = explode(';', $DSN);
        $warehouseData = explode('=', $data[2]);
        return $warehouseData[1];
    }

    public function get_bodegas($principal = false) {
        $bodegas = array();
        $info_bodegas = $this->get_informacion_bodegas($principal);
        foreach ($info_bodegas as $bodega) {
            $bodega['database'] = $this->get_dsn_bodega($bodega['dsn']);
            $bodegas[] = $bodega;
        }

        return $bodegas;
    }

    public function get_tipo_transportes() {
        $this->connection_matriz();
        $this->oConGeneral->select('nomtab as nombre, codtab as codigo');
        $this->oConGeneral->where('numtab', '7001');
        $this->oConGeneral->where('codtab !=', '');
        return $this->oConGeneral->get('maetab')->result_array();
    }

    public function get_tipo_transporte($codtab) {
        $this->connection_matriz();
        $this->oConGeneral->select('nomtab as nombre, codtab as codigo');
        $this->oConGeneral->where('numtab', '7001');
        $this->oConGeneral->where('codtab', $codtab);
        return $this->oConGeneral->get('maetab')->row_array();
    }

    public function get_tipo_producto() {
        $this->connection_matriz();
        $this->oConGeneral->select('nomtab as nombre, codtab as codigo');
        $this->oConGeneral->where('numtab', '46');
        $this->oConGeneral->where('codtab !=', '');
        return $this->oConGeneral->get('maetab')->result_array();
    }

    public function redonder_decimales($valor, $decimales = 2) {
        $response = 0;
        $cantidad_redondear = $valor;
        $data_valor = explode('.', $valor);
        $valor_decimal = substr($data_valor[1], 2, 1);
        $valor_decimal_l = substr($data_valor[1], 3, 1);
        if(($valor_decimal * 1) == 5) {
            $cantidad_redondear = $valor + 0.001;
        }

        if(($valor_decimal_l * 1) > 5 && $valor_decimal == 0) {
            $cantidad_redondear = $valor + 0.006;
        }
        $response = sprintf('%0.' . $decimales . 'f', $cantidad_redondear);
        return floatval($response);
    }

    public function obtener_path_empresa() {
        $id_empresa = $_GET['ID'];
        $this->connection_infosac();
        $this->oConn->where('idemp', $id_empresa);
        $empresa = $this->oConn->get('empresa')->row_array();
        return $empresa['path'];
    }

    public function obtener_info_empresa() {
        $id_empresa = $_GET['ID'];
        $this->connection_infosac();
        $this->oConn->select('nombre_completo, logotipo');
        $this->oConn->where('idemp', $id_empresa);
        $empresa = $this->oConn->get('empresa')->row_array();
        return $empresa;
    }


    public function eliminar_simbolos($string) {
        $string = trim($string);

        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );

        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
        );

        $string = str_replace(
            array("\\", "¨", "º", "-", "~",
                 "#", "@", "|", "!", "\"",
                 "·", "$", "%", "&", "/",
                 "(", ")", "?", "'", "¡",
                 "¿", "[", "^", "<code>", "]",
                 "+", "}", "{", "¨", "´",
                 ">", "< ", ";", ",", ":",
                 ".", " "),
            ' ',
            $string
        );

        return $string;
    }
}

?>
