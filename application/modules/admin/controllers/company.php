<?php 

/**
 * Company
 */
class Company extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('user_agent'));
		$this->load->model(array('admin/admin_model'));
	}

}