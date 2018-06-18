<?php

/**
* Giao dienej
*/
class Appearance extends Admin_Controller {

	private $_table = 'tbl_options';
	private $_id = 'id';
	function __construct() {
		parent::__construct();
		$this->load->model('admin/admin_model');
		$this->data['active'] = 'appearance';
	}

	public function index() {
		$this->data['subtitle'] = 'General setting';
		$this->data['site'] 	= $this->admin_model->get(array(
			'table' => $this->_table,
			'where' => array(
				'lang_code' => $this->admin_lang
			),
			'order_by' => $this->_id.' DESC',
			'get_row' => TRUE 
		));
		$this->data['subview'] 	= 'admin/appearance/index';
		$this->load->view('admin/admin_layout', $this->data);
	}

	public function ajax_save() {
		$id = $this->input->post('id', TRUE);
		$values = $this->admin_model->array_from_post(array(
			'favicon','logo', 'title', 'keyword', 'description', 'hotline', 'phone', 
			'email', 'email_payment', 'email_server', 'email_port', 'email_password', 'address',
			'skype', 'shipping_cost', 'tax', 'facebook', 'instagram', 'youtube', 'pinterest'
		));
		$values['lang_code'] = $this->admin_lang;
		
		$result = $this->admin_model->save(array(
			'table' 	=> $this->_table,
			'data' 		=> $values,
			'primary' 	=> $this->_id,
			'id' 		=> (int) $id 
		));
		//var_dump($id); die();
		if($result > 0) echo 'TRUE';
		else  echo 'FALSE';
	}
}