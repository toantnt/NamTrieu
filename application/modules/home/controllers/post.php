<?php
class Post extends Frontend_Controller {
    function __construct() {
        parent::__construct();
    	$this->load->model('home/home_model');
    	$this->load->helper('home');
    }
    private $_cat 		= 'tbl_post_cat';
	private $_post 		= 'tbl_post';
	private $_postId 	= 'post_id';
    public function category($url,$id,$offset = 0){
    	$limit = 8; 
        $cateid = getChildCat($id,'tbl_category');
        $options = array(
            	'table' => $this->_post,
                'where' => array(
                    'lang_code' => $GLOBALS['lang_code']
                ),
                'where_in' => array('cat_id' => $cateid),
                'get_row' => false,
                'order_by' => $this->_postId.' DESC',
                'total' => 10,
                'offset' => $offset
        );

		$suffix = '?' . $_SERVER['QUERY_STRING'];
        $this->data['list'] = $this->home_model->get($options);
        $this->data['links'] = $this->frontend_pagination($options, $GLOBALS['lang_code'].'/'.$url.'-c'.$id, 10);

        $data_get = array(
        	'table' => $this->_cat,
        	'where' => array(
                'lang_code' => $GLOBALS['lang_code'],
                'cat_id' => $id
            ),
            'get_row' => true,
        );
        $category = $this->home_model->get($data_get);
        $this->data['category'] = $category;

        $data_news = array(
        	'table' => $this->_post,
            'where' => array(
                'lang_code' => $GLOBALS['lang_code']
        	),
        	'get_row' => false,
            'order_by' => $this->_postId.' DESC',
            'limit' => 5,
        );
        $this->data['news'] = $this->home_model->get($data_news);
    	$this->data['subtitle'] = $category->cat_name;
        $this->data['subview'] = 'home/post/category';
        $this->load->view('home/layout', $this->data);
    }

    public function detail($url,$id){
        $post = $this->home_model->get(array(
            'table' => $this->_post,
            'where' => array('post_id' => $id,'lang_code' => $GLOBALS['lang_code']),
            'get_row' => true
        ));
        $this->data['detail'] = $post;
        $data_news = array(
            'table' => $this->_post,
            'where' => array(
                'lang_code' => $GLOBALS['lang_code']
            ),
            'get_row' => false,
            'order_by' => $this->_postId.' DESC',
            'limit' => 5,
        );
        $this->data['news'] = $this->home_model->get($data_news);
        
    	$this->data['subtitle'] = $post->post_name;
        $this->data['subview'] = 'home/post/detail';
        $this->load->view('home/layout_page', $this->data);
    }
    public function tags(){

    }
}