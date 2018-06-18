<?php

class Shop extends Frontend_Controller {

	private $_table = 'tbl_product';
	private $_id	= 'pro_id';

	function __construct() {
		parent::__construct();
		$this->load->model('home/home_model');
		$this->load->library('code_pagination');
	}

	public function index() {
		$this->data['en_url'] = 'en/shop';
		$this->data['vi_url'] = 'vi/san-pham';
		$attr = array(
			'color' => $this->input->get('filter_color', TRUE),
			'size'  => $this->input->get('filter_size', TRUE),
			'price' => $this->input->get('filter_price', TRUE)
		);
		
		$this->data['subtitle'] = ($GLOBALS['lang_code'] == 'vi' ? 'Sản phẩm' : 'Shop');
		$this->data['selectedPrice'] = ($attr['price'] == NULL ? 0 : $attr['price']);
		$this->data['maxPrice']	= $this->home_model->get(array(
			'table' 	 => 'tbl_product',
			'select' => 'MAX(pro_price) as max_price',
			'get_row'=> true
		));
		$list = NULL;
		if(isset($attr['color']) || isset($attr['size']) || isset($attr['price'])) {
			$list = $this->filter($attr);
		} else {
			$list = $this->home_model->get(array(
				'table' 	=> $this->_table,
				'where'		=> array('lang_code' => $GLOBALS['lang_code']),
				'order_by'	=> $this->_id." DESC",
				'get_row'	=> false
			));
		}
		
		$this->data['category'] = $this->home_model->get(array(
			'table' 	=> 'tbl_category',
			'where'		=> array('lang_code' => $GLOBALS['lang_code'], 'cat_ishome' => 0),
			'order_by'	=> "cat_id ASC",
			'get_row'	=> false
		));
		//var_dump($attr);
		//var_dump($list);
		$paged = (isset($_GET['page']) ? $_GET['page'] : 1);

	    $paginator = new Code_Pagination($list, $paged, 12);
	    $paginator->setShowFirstAndLast(true);
	    $paginator->setMainSeperator(NULL);
	    $this->data['list'] 	 = $paginator->getResults();
	    $this->data['paginator'] = '<ul class="paginator">'.$paginator->getLinks($_GET).'</ul>';
		$this->data['subview'] 	 = 'home/shop/index';
		$this->load->view('home/layout_page', $this->data);
	}
	
	public function filter($attr) {
		$result = null;
		if(isset($attr['color'])) {
			$attrRs = $this->home_model->get(array(
				'table' => 'attributes',
				'where' => array('name' => $attr['color']),
				'get_row' => true
			));
			$result = $this->home_model->get(array(
				'table' 		=> 'tbl_product, product_opitons',
				'select'		=> 'tbl_product.*, product_opitons.ID',
				'where' 	=> "(tbl_product.pro_id=product_opitons.productID) AND (product_opitons.attrID='".$attrRs->ID."') AND (lang_code='".$GLOBALS['lang_code']."')",
				'order_by'	=> 'tbl_product.pro_id DESC',
				'get_row' 	=> false
			));
		}
		
		if(isset($attr['size'])) {
			$attrRs = $this->home_model->get(array(
				'table' => 'attributes',
				'where' => array('name' => $attr['size']),
				'get_row' => true
			));
			$result = $this->home_model->get(array(
				'table' 		=> 'tbl_product, product_opitons',
				'select'		=> 'tbl_product.*, product_opitons.ID',
				'where' 	=> "(tbl_product.pro_id=product_opitons.productID) AND (product_opitons.attrID='".$attrRs->ID."') AND (lang_code='".$GLOBALS['lang_code']."')",
				'order_by'	=> 'tbl_product.pro_id DESC',
				'get_row' 	=> false
			));
		} 
		if(isset($attr['price'])) {
			$result = $this->home_model->get(array(
				'table' 		=> 'tbl_product',
				'where' 	=> "(pro_price BETWEEN 0 AND ".$attr['price'].") AND (lang_code='".$GLOBALS['lang_code']."')",
				'order_by'	=> 'pro_id DESC',
				'get_row' 	=> false
			));
		} 
		return $result;
	}

	public function detail($slug, $id) {
		$slug = trim(strip_tags($slug));
		$this->data['product'] = $detail = $this->home_model->get(array(
			'table' => $this->_table,
			'where' => array(
				$this->_id => $id,
				'pro_slug' => $slug,
				'lang_code'=> $GLOBALS['lang_code']
			),
			'get_row' => true
		));
		$this->data['subtitle'] = $detail->pro_name;
		$this->data['proOptions']  = $this->home_model->get(array(
            'table'   => 'product_opitons',
            'where'   => array(
                'productID'  => $id
            ),
            'order_by'=> 'ID ASC',
            'group_by'=> 'groupID',
            'get_row' => false
        ));
        
		$this->data['related'] 	= $this->home_model->get(array(
			'table' => $this->_table,
			'where' => "(pro_id <> ".$detail->pro_id.") AND (lang_code='".$GLOBALS['lang_code']."')",
			'order_by' 	=> $this->_id.' DESC',
			'get_row' 	=> false
		));
		$same = $this->home_model->get(array(
			'table' 		=> $this->_table,
			'where' 	=> array('id_lang' => $detail->id_lang, 'lang_code' => ($GLOBALS['lang_code'] == 'en' ? 'vi' : 'en')),
			'get_row' 	=> true
		));
		if($detail->lang_code == 'en') {
			$this->data['en_url'] = 'en/'.$slug.'-s'.$id;
			$this->data['vi_url'] = 'vi/'.$same->pro_slug.'-s'.$same->pro_id;
		} else {
			$this->data['vi_url'] = 'vi/'.$slug.'-s'.$id;
			$this->data['en_url'] = 'en/'.$same->pro_slug.'-s'.$same->pro_id;
		}
		$this->data['collection'] = $this->home_model->get(array(
			'table' 		=> 'tbl_category',
			'where' 	=> array('cat_id' => $detail->cat_id),
			'get_row' 	=> true
		));
		$this->data['subview']	= 'home/shop/detail';
		$this->load->view('home/layout_page', $this->data);

	}
	public function attribute_gallery() {
	    $attrId = $this->input->post('attr_id', TRUE);
        
        $this->data['attrImge'] = $this->home_model->get(array(
            'table'     => 'product_opitons',
            'where'     => array('attrID' => $attrId),
            'get_row'   => true
        ));
        $this->load->view('home/shop/load_featured', $this->data);
	}
    public function attribute_msg() {
	    $attrId = $this->input->post('attr_id', TRUE);
        
        $detailAttribute = $this->home_model->get(array(
            'table'     => 'attributes',
            'where'     => array('ID' => $attrId),
            'get_row'   => true
        ));
        if($GLOBALS['lang_code'] == 'en') {
            echo 'You have chosen '.$detailAttribute->name;
        } else {
            echo 'Bạn đã chọn '.$detailAttribute->name;
        }
        echo '<input type="hidden" name="color" value="'.$attrId.'" />';
    }
    public function attribute_size_msg() {
        $attrId = $this->input->post('attr_id2', TRUE);
        
        $detailAttribute = $this->home_model->get(array(
            'table'     => 'attributes',
            'where'     => array('ID' => $attrId),
            'get_row'   => true
        ));
        echo $detailAttribute->name;
        echo ' <input type="hidden" name="size" value="'.$attrId.'" />';
    }

}
