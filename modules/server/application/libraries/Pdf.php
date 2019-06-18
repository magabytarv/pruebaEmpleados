<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
 
class Pdf extends TCPDF
{
    function __construct($pag)
    {
        parent::__construct($pag);
    }
}

class Header_Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }

    var $html_header;
    var $top_margin;

    public function setHtmlHeader($html_header) {
        $this->html_header = $html_header;
    }

    public function Header() {
        $this->writeHTMLCell(
            $w = 0, $h = 0, $x = '10', $y = '5`',
            $this->html_header, $border = 0, $ln = 1, $fill = 0,
            $reseth = true, $align = 'top', $autopadding = true);
        // $this->top_margin = $this->GetY() + 5;
    }

    public function Footer() {
        $this->writeHTMLCell(
            $w = 0, $h = 0, $x = '0', $y = '0',
            '', $border = 0, $ln = 1, $fill = 0,
            $reseth = true, $align = 'top', $autopadding = true);
    }

}