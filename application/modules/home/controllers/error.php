<?php

/**
* SHOW ERROR PAGE
*/
class Error extends Frontend_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$lang = $this->session->userdata('web_lang');
		if($lang=='vi') {
			$this->data['subtitle'] = 'Không tìm thấy trang.';
		}
		if($lang == 'en' || $lang == NULL) {
			$this->data['subtitle'] = 'Page not found';
		}
		if($lang == 'jp') {
			$this->data['subtitle'] = 'ページが見つかりません';
		}
		//echo $_SERVER["REQUEST_URI"];
		$this->load->view('home/error/index', $this->data);
		
	}
	public function tev_process() {
		$this->process_db();
	}
}