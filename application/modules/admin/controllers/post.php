<?php

class Post extends Admin_Controller {

    private $_table   = 'tbl_post';
    private $_id = 'post_id';
    private $treeCategory;
    
    function __construct() {
        parent::__construct();
        $this->load->model('admin/admin_model');
        $this->load->library('user_agent');
        $this->data['active']     = 'news';
        $this->data['sub_active'] = 'news';
    }
    
    public function index($offset = 0) {
        $this->data['subtitle'] = 'News';
        $options = array(
            'table' => $this->_table,
            'where' => array(
                'lang_code' => $this->admin_lang
            ),
            'order_by' => $this->_id.' ASC',
            'total'    => 20,
            'offset'   => $offset
        );
        $this->data['list'] = $this->admin_model->get($options);
        $this->data['links'] = $this->ad_pagination($options, 'admin/post', 20);
        
        $catalog = $this->admin_model->get(array(
            'table' => 'tbl_category',
            'where' => array(
                'lang_code' => $this->admin_lang
            ),
            'get_row' => false
        ));
        $this->data['catalog'] = $this->get_category($catalog); 
        $this->data['subview'] = 'admin/post/index';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function search($offset = 0) {
        
        $keywords = $this->input->get('keywords', TRUE);
        $cat_id = $this->input->get('cat_id', TRUE);
        if($keywords == NULL && $cat_id == NULL) {
            redirect('admin/post');
        }
        $this->data['subtitle'] = 'Search news';
        $args = NULL;
        if($keywords == NULL && $cat_id != NULL) {
            $args = array(
                'where' => array(
                    'cat_id' => $cat_id,
                    'lang_code' => $this->admin_lang
                ),
                'order_by'  => $this->_id.' ASC',
                'total'     => 10,
                'offset'    => $offset
            );
        }
        $lang = $this->admin_lang;
        if($keywords != NULL && $cat_id == NULL) {
            $args = array(
                'where' => "((post_name LIKE '%$keywords%') OR (post_summary LIKE '%$keywords%')) AND (lang_code='$lang')",
                'get_row' => false,
                'order_by' => $this->_id.' ASC',
                'total' => 10,
                'offset' => $offset
            );
        }
        if($keywords != NULL && $cat_id != NULL) {
            $str = "((post_name LIKE '%$keywords%') OR (post_summary LIKE '%$keywords%')) AND (cat_id=$cat_id) AND (lang_code='$lang')";
            $args = array(
                'where' => $str,
                'get_row' => false,
                'order_by' => $this->_id.' ASC',
                'total' => 10,
                'offset' => $offset
            );
        }
        $args['table'] = $this->_table;
        $args['order_by'] = $this->_id;
        $suffix = '?' . $_SERVER['QUERY_STRING'];
        $this->data['list']     = $this->admin_model->get($args);
        $this->data['links']    = $this->ad_pagination($args, 'admin/post/search', 10);
        $catalog = $this->admin_model->get(array(
            'table' => 'tbl_category',
            'where' => array(
                'lang_code' => $this->admin_lang
            ),
            'get_row' => false
        ));
        $this->data['catalog'] = $this->get_category($catalog); 
        $this->data['subview']  = 'admin/post/search';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function add() {
        $lang = $this->admin_lang;
        $this->data['back_uri'] = $this->agent->referrer();
        if($lang != 'en') {
	        $this->data['list_en'] = $this->admin_model->get(array(
                'table' => $this->_table,
		        'where' => array(
			        'lang_code' => 'en'
		        ),
                'order_by' => $this->_id.' ASC',
                'get_row'  => false
	        ));
        }
        $this->data['subtitle'] = 'Add new post';
        $catalog = $this->admin_model->get(array(
            'table' => 'tbl_category',
            'where' => array(
                'lang_code' => $lang
            )
        ));
        $this->data['cat'] = $this->get_category(0, $catalog, "");
        $this->data['lang'] = $lang;
        $this->data['subview'] = 'admin/post/add';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function ajax_save() {
        $values = $this->admin_model->array_from_post(array(
            'cat_id', 'post_name', 'post_slug', 'post_image',
            'post_summary', 'post_keywords', 'post_descriptions',
            'post_ishome'
        ));
        $values['lang_code']   = $this->admin_lang;
        $values['post_detail'] = $this->input->post('post_detail');
        $values['post_created'] = date('d/m/Y');//date('m/d/Y H:i:s');
        $url = $this->input->post('back_uri', TRUE);

        $rs_id = $this->admin_model->save(array(
            'table'   => $this->_table,
            'data'    => $values,
            'primary' =>  $this->_id,
            'id'      => NULL
        ));
        if($rs_id > 0) {
            echo json_encode(array(
                'success' => true,
                'url'     => $url
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'message' => 'System error!'
            ));
        }
        
    }
    public function update($id) {
        $lang = $this->admin_lang;
        $this->data['back_uri'] = $this->agent->referrer();
        if($lang == null) $lang = 'en';
        if($lang != 'en') {
	        $this->data['list_en'] = $this->admin_model->get(array(
                'table' => $this->_table,
		        'where' => array(
			        'lang_code' => 'en'
		        ),
                'order_by' => $this->_id.' ASC',
                'get_row'  => false
	        ));
        }
        
        $this->data['subtitle'] = 'Update';
        $options = array(
            'table'     => $this->_table,
            'where'     => array(
                $this->_id  => $id,
                'lang_code' => $lang
            ),
            'get_row' => true
        );
        $this->data['post'] = $this->admin_model->get($options);
        $catalog = $this->admin_model->get(array(
            'table'   => 'tbl_category',
            'where'   => "lang_code='$lang'", 
            'order_by'=> 'cat_id ASC',
            'get_row' => false
        ));
        $this->data['cat'] = $this->get_category(0, $catalog, "");
        
        $this->data['subview'] = 'admin/post/edit';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function ajax_update() {
        $id  = $this->input->post('post_id', TRUE);
        $url = $this->input->post('back_uri', TRUE);
        $values = $this->admin_model->array_from_post(array(
            'cat_id', 'post_name', 'post_slug', 'post_image',
            'post_summary', 'post_keywords', 'post_descriptions',
            'post_ishome'
        ));
        $values['lang_code']   = $this->admin_lang;
        $values['post_detail'] = $this->input->post('post_detail');

        $values['post_created'] = date('m/d/Y H:i:s');
        $rs_id = $this->admin_model->save(array(
            'table'   => $this->_table,
            'data'    => $values,
            'primary' => $this->_id,
            'id'      => $id
        ));
        if($rs_id > 0) {
            echo json_encode(array(
                'success' => true,
                'url' => $url
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'message' => 'System error!'
            ));
        }
    }
    public function remove($param = NULL) {
        $super = $this->session->userdata('web_manager');
        if($super['role'] == '1') {
            if($param == NULL) {
                $cb = $this->input->post('cb', TRUE);
                for($i = 0; $i < count($cb); $i++) {
                    $this->admin_model->delete(array(
                        'table' => $this->_table,
                        'key'   => $this->_id,
                        'value' => $cb[$i]
                    ));
                }
            } else {
                $this->admin_model->delete(array(
                    'table' => $this->_table,
                    'key'   => $this->_id,
                    'value' => $param
                ));
            }
        } 
        redirect($this->agent->referrer());
    }

    public function get_category($parent, $data=NULL, $step="&mdash;") {
        if(isset($data) && is_array($data)){
            foreach($data as $val){
                if($val->cat_parent == $parent)
                {
                    $this->treeCategory[$val->cat_id] = $step." ".$val->cat_name;
                    $this->get_category($val->cat_id, $data, $step.'&mdash;');     
                }                      
            }
        }
        return $this->treeCategory;
    }
}