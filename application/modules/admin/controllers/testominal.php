<?php

/**
 * User manage
 */
class Testominal extends Admin_Controller {
	private $table_name = 'tbl_testominals';
    private $primary = 'testominal_id';

    function __construct() {
        parent::__construct();
        $this->load->model('admin/admin_model');
        $this->load->library('user_agent');
        $this->data['active'] = 'media';
        $this->data['sub_active'] = 'testominal';
    }

    public function index() {
        $this->data['subtitle'] = 'testominals management';
        $options = array(
            'table'  => $this->table_name,
            'order_by' => $this->primary.' DESC',
            'get_row' => false
        );
        $this->data['list'] = $this->admin_model->get($options);
        $this->data['subview'] = 'admin/testominal/index';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function add() {
        $this->data['query_string'] = $this->agent->referrer();
        $this->data['subtitle'] = 'Add testominal';
        $this->data['subview'] = 'admin/testominal/add';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function save() {
        $id = $this->input->post('testominal_id', TRUE);
        $data = $this->admin_model->array_from_post(array('testominal_name', 'testominal_position', 'testominal_content', 'testominal_image'));
        $values = array(
            'table' => $this->table_name,
            'data'  => $data,
            'primary' => $this->primary,
            'id'    => (isset($id) ? $id : NULL)
        );
        $saveid = $this->admin_model->save($values);
        if ($saveid > 0 || $saveid == TRUE) {
            echo 'TRUE';
        } else {
            echo 'FALSE';
        }
    }
    public function edit($id) {
        $this->data['subtitle'] = 'Edit testominal';
        $this->data['query_string'] = $this->agent->referrer();
        $options = array(
            'table' => $this->table_name,
            'where' => array(
                $this->primary => (int) $id
            ),
            'get_row' => true
        );
        $this->data['id'] = $id;
        $this->data['testominal'] = $this->admin_model->get($options);
        $this->data['subview'] = 'admin/testominal/edit';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function delete($id = NULL) {
        $super = $this->session->userdata('web_manager');
        if($super['role'] == '1') {
            if ($id == NULL) {
                $arr_id = $this->input->post('cb', TRUE);
                foreach ($arr_id as $item) {
                    $this->admin_model->delete(array(
                        'table'     => $this->table_name,
                        'key'       => $this->primary,
                        'value'     => $item
                    ));
                }
            } else {
                $this->admin_model->delete(array(
                    'table'     => $this->table_name,
                    'key'       => $this->primary,
                    'value'     => $id
                ));
            }
        }
        //$str = isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : '';
        redirect($this->agent->referrer());
    }
}