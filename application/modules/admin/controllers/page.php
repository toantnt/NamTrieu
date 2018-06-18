<?php

class Page extends Admin_Controller {

    private $_table   = 'tbl_pages';
    private $_id = 'page_id';

    function __construct() {
        parent::__construct();
        $this->load->model('admin/admin_model');
        $this->data['active'] = 'pages';
        $this->data['sub_active'] = 'page';
    }

    public function index($offset = 0) {
        $keywords = $this->input->get('keywords', TRUE);
        $options = NULL;
        if($keywords == NULL || !isset($keywords)) {
            $this->data['subtitle'] = 'Pages';
            $options = array(
                'table' => $this->_table,
                'where' => "lang_code='".$this->admin_lang."'",
                'order_by' => $this->_id.' DESC',
                'total' => 10,
                'offset' => $offset
            );
            $this->data['list'] = $this->admin_model->get($options);
            $this->data['links'] = $this->ad_pagination($options, 'admin/page', 10);
        } else {
            $this->data['subtitle'] = 'Search results: "'.$keywords.'"';
            $options = array(
                'table' => $this->_table,
                'where' => "((page_title LIKE '%$keywords%') OR (page_summary LIKE '%$keywords%')) AND (lang_code='".$this->admin_lang."')",
                'order_by' => $this->_id.' DESC',
                'total' => 10,
                'offset' => $offset
            );
            $this->data['list'] = $this->admin_model->get($options);
            $this->data['links'] = $this->ad_pagination( $options,'admin/page', 10);
        }
        
        $this->data['subview'] = 'admin/page/index';
        $this->load->view('admin/admin_layout', $this->data);
    }

    public function add() {
        $this->data['subtitle'] = 'Create page';
        $this->data['subview'] = 'admin/page/create';
        $this->load->view('admin/admin_layout', $this->data);
    }

    public function ajax_save() {
        $values = $this->admin_model->array_from_post(array(
            'page_title', 'page_slug', 'page_summary', 'page_type',
            'page_keywords', 'page_description', 'page_active'
        ));
        $values['page_detail'] = $this->input->post('page_detail');
        $values['lang_code']  = $this->admin_lang;
        $id = $this->input->post('page_id', TRUE);

        $dataInsert = array(
            'table' => $this->_table,
            'data' => $values,
            'primary' => $this->_id,
            'id'    => (isset($id) ? $id : NULL)
        );
        $result = $this->admin_model->save($dataInsert);
        if($result > 0) {
            echo json_encode(array(
                'success' => true,
                'url' => 'admin/page'
            ));
        } else {
            echo json_encode(array(
                'success' => false
            ));
        }
    }
    public function update($id) {
        $this->data['subtitle'] = 'Update page';
        $options = array(
            'table' => $this->_table,
            'where' => array(
                $this->_id => $id
            ),
            'get_row' => true
        );
        $this->data['page'] = $this->admin_model->get($options);
        $this->data['subview'] = 'admin/page/update';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function ajax_update() {
        $values = $this->admin_model->array_from_post(array(
            'page_title', 'page_slug', 'page_summary', 'page_type',
            'page_keywords', 'page_description', 'page_active'
        ));
        $id = $this->input->post('page_id', TRUE);
        $values['page_detail'] = $this->input->post('page_detail');
        $values['lang_code'] = $this->admin_lang;
        $dataUpdate = array(
            'table' => $this->_table,
            'data'  => $values,
            'primary' => $this->_id,
            'id'    => $id
        );
        $result = $this->admin_model->save($dataUpdate);
        if($result > 0) {
            echo json_encode(array(
                'success' => true,
                'url' => 'admin/page'
            ));
        } else {
            echo json_encode(array(
                'success' => false
            ));
        }
    }
    public function page_active() {
        $id = $this->input->post('page_id', TRUE);
        $active = $this->input->post('active', TRUE);
        $temp = ($active == 1 ? 0 : 1);
        $values = array('page_active' => $temp);
        
        $rs = $this->admin_model->save(array(
            'table' => $this->_table,
            'data'  => $values,
            'primary' => $this->_id,
            'id'    => $id
        ));
        if($rs > 0) {
            echo json_encode(array(
                'success' => true,
                'url' => 'admin/page'
            ));
        } else {
            echo json_encode(array(
                'success' => false
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
        redirect('admin/page');
    }
}
