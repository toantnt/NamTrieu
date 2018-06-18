<?php
require_once APPPATH . "third_party/PHPExcel.php";
//require_once APPPATH. "third_party/PHPExcel/Writer/Excel2007.php";
class Excel extends PHPExcel {

    public function __construct() {
        parent::__construct();
    }
}