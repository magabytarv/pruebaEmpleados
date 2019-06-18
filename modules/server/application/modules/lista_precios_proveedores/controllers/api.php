<?php
defined("BASEPATH") OR exit("No direct script access allowed");

require APPPATH . "/libraries/REST_Controller.php";

class api extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION["UID"])) {
            session_start();
        }

        $this->load->model("lista_precios_proveedores_model");
        $this->load->model('generales/Proveedores_model', 'proveedores_model');
        $this->load->model('diferencial_cambiario/diferencial_cambiario_model', 'diferencial_cambiario_model');
        $this->load->model("generales/configuraciones_model", "configuraciones_model");
        $this->load->model("generales/productos_model", "productos_model");
        $this->load->model("generales/usuarios_model", "usuarios_model");
    }

    public function lista_precios_proveedores_get($codigo_proveedor) {
        $response = array();
        $productos = $this->lista_precios_proveedores_model->obtener_lista_precios_proveedo($codigo_proveedor);

        foreach ($productos as $producto) {
            $data_producto = $this->productos_model->get_producto_por_codigo($producto['codigo_producto']);
            $data_proveedor = $this->proveedores_model->get_proveedor($producto['codigo_proveedor']);
            $data_moneda = $this->configuraciones_model->get_tipo_moneda($producto['codigo_moneda']);

            $producto['descripcion'] = $data_producto['descripcion'];
            $producto['nombre_proveedor'] = $data_proveedor['proveedor'];
            $producto['moneda'] = $data_moneda['moneda'];
            $response[] = $producto;
        }
        echo format_response($response);
    }

    public function validar_lista_precios_proveedores_post() {
        $data = $this->post();
        $proveedor = $data['data']['proveedor'];
        $tipo_moneda = $data['data']['tipo_moneda'];
        $productos = $data['data']['productos'];
        $tipo_carga = $data['data']['tipo_carga'];
        $nombre_archivo = $data['data']['nombre_archivo'];

        $path_empresa  = $this->lista_precios_proveedores_model->obtener_path_empresa();

        $link_archivo = $path_empresa . '/documentos_extra/' . $nombre_archivo;

        $guardar_lista_precios = true;

        $response = array(
            'estado' => true,
            'productos' => array()
        );

        $productos_guardar = array();
        $fecha_carga = date('Y-m-d H:i:s');

        $linea = 2;
        foreach ($productos as $key => $producto) {
            $producto_existe = $this->productos_model->producto_existe_bodega_matriz($producto['codigo_producto']);
            if($producto_existe) {
                $producto_guardar = array(
                    'codigo_producto' => $producto['codigo_producto'],
                    'codigo_proveedor' => $proveedor,
                    'precio_unitario' => $producto['precio'],
                    'codigo_moneda' => $tipo_moneda,
                    'uid' => $_SESSION['UID'],
                    'fecha_carga' => $fecha_carga,
                );
                $productos_guardar[] = $producto_guardar;
            } else {
                $guardar_lista_precios = false;
                $response['estado'] = fasle;
                $producto['linea'] = $linea;
                $producto['mensaje_error'] = 'El producto no existe';
                $response['productos'][] = $producto;
            }
            $linea++;
        }

        if($guardar_lista_precios) {
            if($tipo_carga == 1) {
                $this->lista_precios_proveedores_model->eliminar_lista_precios_proveedor($proveedor);
                $this->lista_precios_proveedores_model->remplazar_lista_precios_proveedores($productos_guardar);
            } else {
                $this->lista_precios_proveedores_model->remplazar_lista_precios_proveedores($productos_guardar);
            }
            $data_insert = array(
                'codigo_proveedor' => $proveedor,
                'link_archivo' => $link_archivo,
                'uid' => $_SESSION['UID'],
                'fecha_carga' => $fecha_carga,
            );
            $this->lista_precios_proveedores_model->guardar_historial_lista_precios_proveedores($data_insert);
        }

        echo format_response($response);
    }

    public function guardar_archivo_post() {
        $path_empresa  = $this->lista_precios_proveedores_model->obtener_path_empresa();

        if (!empty($_FILES)) {
            $tempPath = $_FILES['file']['tmp_name'];
            $uploadPath = dirname(__FILE__) . '/../../../../../../../' . $path_empresa . '/documentos_extra/' . $_FILES['file']['name'];
            move_uploaded_file($tempPath, $uploadPath);
        }
    }

    public function obtener_proveedores_get() {
        $proveedores = $this->proveedores_model->get_proveedores();
        echo format_response($proveedores);
    }

    public function obtener_tipos_monedas_get() {
        $response = array();
        $monedas = $this->diferencial_cambiario_model->obtener_diferencial_cambiarios();
        foreach ($monedas as $moneda) {
            $data_moneda = $this->configuraciones_model->get_tipo_moneda($moneda['codigo']);
            $moneda['descripcion'] = $data_moneda['moneda'];
            $response[] = $moneda;
        }
        echo format_response($response);
    }

    public function historial_precios_proveedores_post() {
        $data = $this->post();

        $codigo_proveedor = $data['data']['codigo_proveedor'];
        $fecha_desde = $data['data']['fecha_desde'];
        $fecha_hasta = $data['data']['fecha_hasta'];

        $path_empresa  = $this->lista_precios_proveedores_model->obtener_path_empresa();
        $response = array();

        $listas_precios_proveedor = $this->lista_precios_proveedores_model->obtener_historial_precios_proveedo($codigo_proveedor, $fecha_desde, $fecha_hasta);

        foreach ($listas_precios_proveedor as $key => $lista_precios_proveedor) {
            $lista_precios_proveedor['link_archivo'] = $lista_precios_proveedor['link_archivo'];
            $nombre_archivo = str_replace($path_empresa . '/documentos_extra/', '',$lista_precios_proveedor['link_archivo']);
            $usuario = $this->usuarios_model->get_usuario_by_codigo($lista_precios_proveedor['uid']);
            $lista_precios_proveedor['nombre_usuario'] = $usuario['nombre_usuario'];
            $lista_precios_proveedor['nombre_archivo'] = $nombre_archivo;
            $response[] = $lista_precios_proveedor;
        }
        echo format_response($response);
    }

    public function generar_excel_post() {
        $data = $this->post();
        $productos = $data['productos'];
        $proveedor = $data['proveedor'];
        $fecha = date('Y-m-d H:i:s');

        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
        ->setCreator("Cattivo")
        ->setLastModifiedBy("Cattivo")
        ->setTitle("Precios proveedor")
        ->setSubject("Reporte Precios Proveedor")
        ->setDescription("proveedor")
        ->setKeywords("Excel Office 2007 openxml php")
        ->setCategory("Reportes");

        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("A")->setAutoSize(true);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("B")->setAutoSize(true);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("C")->setAutoSize(true);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("D")->setAutoSize(true);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("E")->setAutoSize(true);


        $styleArray = array(
            'font' => array(
                'bold' => true
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->applyFromArray($styleArray);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A3:E3')->applyFromArray($styleArray);

        $fila = 1;

        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$fila, 'PROVEEDOR');

         $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValueExplicit('B'.$fila, $proveedor['proveedor'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValueExplicit('C'.$fila, $proveedor['identificacion'], PHPExcel_Cell_DataType::TYPE_STRING);

        $fila = 3;

        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$fila, 'CÓDIGO PRODUCTO')
        ->setCellValue('B'.$fila, 'DESCRIPCIÓN')
        ->setCellValue('C'.$fila, 'PRECIO UNITARIO')
        ->setCellValue('D'.$fila, 'MONEDA')
        ->setCellValue('E'.$fila, 'FECHA CARGA');
        $fila++;
        foreach ($productos as $producto) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValueExplicit('A'.$fila, $producto['codigo_producto'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValue('B'.$fila, $producto['descripcion'])
                ->setCellValue('C'.$fila, $producto['precio_unitario'])
                ->setCellValue('D'.$fila, $producto['moneda'])
                ->setCellValue('E'.$fila, $producto['fecha_carga']);
            $fila++;
        }

        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-Type: Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="listado.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header ('Last-Modified: ' . gmdate('D, d M Y H:i:s').' GMT');
        header ('Cache-Control: cache, must-revalidate');
        header ('Pragma: public');
        $objWriter->save('php://output');
    }


    public function generar_pdf_post() {
        $data = $this->post();
        $productos = $data['productos'];
        $proveedor = $data['proveedor'];
        $fecha = date('Y-m-d H:i:s');

        ini_set('memory_limit', '512M');

        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Motransa');
        $pdf->SetTitle('REPORTE PRECIOS PROVEEDOR');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->setFontSubsetting(false);

        $pdf->AddPage();
        $pdf->SetFont('helvetica', 'B', 12, '', true);

        $pdf->Cell(0, 0, 'REPORTE PRECIOS PROVEEDOR', 0, 1, 'C');
        $pdf->ln();
        $pdf->SetFont('helvetica', 'B', 10, '', true);

        $pdf->SetX(20);
        $pdf->SetFont('helvetica','',9);


        $html = "";
        $html .= "<style type=text/css>";
        $html .= "table  , td {border: 1px solid black;}";
        $html .= "h2{font-weight: bold;  text-align:center;}";
        $html .= "</style>";
        $html .= "<h4> PROVEEDOR: " . $proveedor['proveedor'] . " " . $proveedor['identificacion']  . "</h4>";
        $html .= "<table cellspacing='0' cellpadding='5' border='1' width='100%'>";
        $html .= '<tr>
                    <td align="center" width="20%"><b>CÓDIGO PRODUCTO</b></td>
                    <td align="center" width="20%"><b>DESCRIPCIÓN</b></td>
                    <td align="center" width="20%"><b>PRECIO UNITARIO</b></td>
                    <td align="center" width="20%"><b>MONEDA</b></td>
                    <td align="center" width="20%"><b>FECHA CARGA</b></td>
                  </tr>';

        foreach ($productos as $producto) {
            $html .='<tr>
                        <td>' . $producto["codigo_producto"] .'</td>
                        <td>' . $producto["descripcion"] .'</td>
                        <td align="right">' . $producto['precio_unitario'] .'</td>
                        <td>' . $producto["moneda"] . '</td>
                        <td>' . $producto["fecha_carga"] . '</td>
                    </tr>';
        }

        $html .= '</table>';

        $pdf->writeHTMLCell($w = 170, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 0, $fill = 0, $reseth = true, $align = '');

        $nombre_archivo = utf8_decode('historial_' . $fecha_descarga . '.pdf');
        $pdf->Output($nombre_archivo, 'I');
    }
}
?>
