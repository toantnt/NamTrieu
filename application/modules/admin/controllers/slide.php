<?php

class Slide extends Admin_Controller {
    private $table_id = 'slide_id';
    private $order = 'slide_order';
    private $table = 'tbl_slide';
    
    function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('user_agent');
        $this->data['active'] = 'media';
        $this->data['sub_active'] = 'slide';
        if($this->admin_lang != 'en') {
            $this->data['list_en'] = $this->admin_model->get(array(
                'table'     => $this->table,
                'where'     => array('lang_code' => 'en'),
                'order_by'    => $this->table_id.' DESC',
                'get_row'     => false 
            ));
        } 
    }
    public function index($offset = 0) {
        $this->data['subtitle'] = 'Slide banner';
        $options = array(
            'table' => $this->table,
            'where' => array(
                'lang_code' => $this->admin_lang 
            ),
            'get_row' => false,
            'order_by' => $this->table_id.' ASC',
            'total' => 10,
            'offset' => $offset
        );
        $this->data['list'] = $this->admin_model->get($options);
        $this->data['links'] = $this->ad_pagination($options, 'admin/slide/index', 10);
        
        $this->data['collection'] = $this->admin_model->get(array(
        	'table' 		=> 'tbl_category',
        	'where'		=> array('lang_code' => $this->admin_lang),
        	'order_by' 	=> 'cat_id DESC',
        	'limit' 		=> 20,
        	'get_row'	=> false
        ));
        $this->data['subview'] = 'admin/slide/index';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function save() {
        $values = array(
            'slide_name'  		=> $this->input->post('slide_name',TRUE),
            'slide_image' 		=> $this->input->post('slide_image',TRUE),
            'slide_summary' 		=> $this->input->post('slide_summary',TRUE),
            'slide_collection'  => $this->input->post('slide_collection',TRUE), 
            'lang_code'   		=> $this->admin_lang,
        );
        $insert = $this->db->insert($this->table, $values); 
        if($insert > 0){
            echo 'TRUE';
        }else{
            echo 'FALSE';
        }  
    }
    public function edit() {
        $id = $this->input->post('slide_id', TRUE);
        $post = $this->admin_model->get(array(
            'table' => $this->table,
            'where' => array('slide_id' => $id),
            'get_row' => true
        ));
        $this->data['result'] = $post;
        $this->data['subtitle'] = 'Edit slide';
        //$this->data['subview'] = ;
        $this->data['collection'] = $this->admin_model->get(array(
        	'table' 		=> 'tbl_category',
        	'where'		=> array('lang_code' => $this->admin_lang),
        	'order_by' 	=> 'cat_id DESC',
        	'limit' 		=> 20,
        	'get_row'	=> false
        ));
        $this->load->view('admin/slide/edit', $this->data);
    }
    public function ajax_edit() {
        $id = $this->input->post('slide_id', TRUE);
        $values = array(
            'slide_name'  		=> $this->input->post('slide_name',TRUE),
            'slide_image' 		=> $this->input->post('slide_image',TRUE),
            'slide_summary' 		=> $this->input->post('slide_summary',TRUE),
            'slide_collection'  => $this->input->post('slide_collection',TRUE), 
            'lang_code'  => $this->admin_lang,
        );
        $this->db->where('slide_id', $id);
        $update = $this->db->update($this->table, $values); 
        if($update){
            echo 'TRUE';
        }else{
            echo 'FALSE';
        }  
    }

    public function create() {
        $this->data['subtitle'] = 'Add slide';
        $this->data['subview'] = 'admin/slide/create';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function remove($param=NULL) {
        $super = $this->session->userdata('web_manager');
        if($super['role'] == '1') {
            if($param == NULL) {
                $cb = $this->input->post('cb', TRUE);
                for($i = 0; $i < count($cb); $i++) {
                    $this->admin_model->delete(array(
                        'table' => $this->table,
                        'key'   => $this->table_id,
                        'value' => $cb[$i]
                    ));
                }
            } else {
                $this->admin_model->delete(array(
                        'table' => $this->table,
                        'key'   => $this->table_id,
                        'value' => $param
                    ));
            }
        } 
        redirect('admin/slide');
    }
}

