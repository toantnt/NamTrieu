<?php 

class Category extends Frontend_Controller {

	private $_table = 'tbl_post_cat';
	private $_id	= 'c_id';
	private $_post  = 'tbl_post';
	private $_postId= 'post_id';

	function __construct() {
		parent::__construct();
		$this->load->model('home/home_model');
	}

	public function index($slug, $id) {
		$category = $this->home_model->get(array(
			'table' => $this->_table,
			'where' => array(
				$this->_id => $id,
				'c_slug'	   => strip_tags($slug),
				'lang_code'=> $GLOBALS['lang_code'],
			),
			'order_by' => $this->_id,
			'get_row'  => true 
		));
		$this->data['subtitle'] = $category->c_name;
		$this->data['posts'] 	= $this->home_model->get(array(
			'table' => $this->_post,
			'where' => array(
				'c_id'	   => $id,
				'lang_code'=> $GLOBALS['lang_code'],
			),
			'order_by' => $this->_postId." DESC",
			'get_row'  => false 
		));

		$same = $this->home_model->get(array(
			'table' 	=> $this->_table,
			'where'		=> array('id_lang' => $category->id_lang,'lang_code' => ($category->lang_code=='en' ? 'vi' : 'en')),
			'get_row'	=> true
		));
		if($category->lang_code=='en') {
			$this->data['en_url'] = 'en/'.$slug.'-c'.$id;
			$this->data['vi_url'] = 'vi/'.$same->c_slug.'-c'.$same->c_id;
		} else {
			$this->data['en_url'] = 'en/'.$same->c_slug.'-c'.$same->c_id;
			$this->data['vi_url'] = 'vi/'.$slug.'-c'.$id;
		}
		$this->data['subview']	= 'home/category/index';
		$this->load->view('home/layout_page', $this->data);
	}
	
	public function load_more() {
		
	}
}