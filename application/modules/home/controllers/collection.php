<?php 

class Collection extends Frontend_Controller {

	private $_table = 'tbl_category';
	private $_id	= 'cat_id';

	function __construct() {
		parent::__construct();
		$this->load->model('home/home_model');
	}
	// http://lapham.com.vn/collection/slug
	public function index($slug=NULL) {
		$cat = null;
		if($slug == NULL) {
			$this->data['en_url'] = 'en/collection';
			$this->data['vi_url'] = 'vi/bo-suu-tap';
			$this->data['subtitle']  = ($GLOBALS['lang_code'] == 'vi' ? 'Bộ sưu tập' : 'Collection');
			$this->data['collection']= $cat  = $this->home_model->get(array(
				'table' 	=> $this->_table,
				'where'		=> array('cat_status' => 1, 'cat_ishome' => 1, 'lang_code' => $GLOBALS['lang_code']),
				'order_by' 	=> $this->_id.' DESC',
				'get_row'	=> true
			));
		} else {
			$slug = trim($slug);
			$cat  = $this->home_model->get(array(
				'table' 	=> $this->_table,
				'where'		=> array('cat_slug' => strip_tags($slug),'lang_code' => $GLOBALS['lang_code']),
				'order_by' 	=> $this->_id.' DESC',
				'get_row'	=> true
			));
			$this->data['subtitle'] 	= $cat->cat_name;
			$this->data['collection'] 	= $cat;

			$same = $this->home_model->get(array(
				'table' 	=> $this->_table,
				'where'		=> array('id_lang' => $cat->id_lang,'lang_code' => ($cat->lang_code=='en' ? 'vi' : 'en')),
				'get_row'	=> true
			));
			if($cat->lang_code=='en') {
				$this->data['en_url'] = 'en/collection/'.$slug;
				$this->data['vi_url'] = 'vi/bo-suu-tap/'.$same->cat_slug;
			} else {
				$this->data['vi_url'] = 'vi/bo-suu-tap/'.$slug;
				$this->data['en_url'] = 'en/collection/'.$same->cat_slug;
			}
		}
		$this->data['others'] = $this->home_model->get(array(
			'table' 		=> $this->_table,
			'where'		=> "(cat_status=1) AND (cat_id <> ".$cat->cat_id.") AND (cat_ishome=1) AND (lang_code='".$GLOBALS['lang_code']."')",
			'order_by' 	=> $this->_id.' DESC',
			'limit'		=> 4,
			'get_row'	=> false
		));
		$this->data['products'] = $this->home_model->get(array(
			'table'		=> 'tbl_product',
			'where'		=> "(cat_id LIKE '%".$cat->cat_id."%') AND (lang_code='".$GLOBALS['lang_code']."')",
			'order_by'	=> 'pro_id DESC',
			'get_row'	=> false
		));
		$this->data['subview'] = 'home/collection/index';
		$this->load->view('home/layout_page', $this->data);
	}

}