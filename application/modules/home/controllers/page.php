<?php 

class Page extends Frontend_Controller {

	private $_table = 'tbl_pages';
	private $_id 	= 'page_id';

	function __construct() {
		parent::__construct();
		$this->load->model('home/home_model');
	}

	public function contact()
	{
		$this->data['subtitle'] = $this->lang->line('contact');
		$this->data['subview']  = 'home/page/contact';
		$this->load->view('home/layout_page', $this->data);
	}
}