<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of MY_Controller
 * @author toandd
 */

class MY_Controller extends MX_Controller
{

    public $data = array();

    function __construct()
    {
        parent::__construct();
        $this->data['errors'] = array();
    }

}