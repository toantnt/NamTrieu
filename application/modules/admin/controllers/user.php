<?php

/**
 * User manage
 */
class User extends Admin_Controller {

    private $table_name = 'tbl_user';
    private $primary = 'user_id';

    function __construct() {
        parent::__construct();
        $this->load->model('admin/admin_model');
        $this->load->library('user_agent');
        $this->data['active'] = 'user';
    }

    public function index() {
        $this->data['subtitle'] = 'Users management';
        $options = array(
            'table'  => $this->table_name,
            'order_by' => $this->primary.' DESC',
            'get_row' => false
        );
        $this->data['list'] = $this->admin_model->get($options);
        $this->data['subview'] = 'admin/user/index';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function edit($id=NULL)
    {
        if($id == NULL) {
            $this->data['subtitle'] = 'Add user';
            $this->data['id'] = $this->data['member'] = NULL;
            $this->data['subview'] = 'admin/user/edit';
            $this->load->view('admin/admin_layout', $this->data);
        } else {
            $this->data['subtitle'] = 'Update user';
            $this->data['id'] = $id;
            $this->data['member'] = $this->admin_model->get(array(
                'table' => $this->table_name,
                'where' => array($this->primary => $id), 
                'get_row' => true));
            $this->data['subview'] = 'admin/user/edit';//$this->admin_m->get($this->table)
            $this->load->view('admin/admin_layout', $this->data);
        }
    }
    public function profile($id)
    {
        $options = array(
            'where' => array(
                'id' => $id
            ),
            'result' => 0
        );
        $this->data['user'] = $this->admin_model->get($this->table_name, $options);
        $this->data['subview'] = 'users/controlpanel/profile';
        $this->load->view('theme/admin/layout', $this->data);

    }
    /**
    * Role:
    * 1: super admin
    * 2: mod
    * 3: shop member
    * 4: user member
    */
    public function save()
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $usid = $this->input->post('id');
        $id = 0;
        $data = $this->admin_model->array_from_post(array(
            'user_role','user_firstname', 'user_lastname', 
            'user_username', 'user_password',
            'user_email'));
        //$email = $data['email'];
        //$result = $this->admin_m->get($this->table, array('where' => "email='$email'", 'result' => 0));
        $password = $data['user_password'];
        if($data['user_password'] == NULL) {
            unset($data['user_password']);
        } else {
            $data['user_password'] = md5(md5($data['user_password']));
        }
        $id = $this->admin_model->save(array(
            'table' => $this->table_name,
            'data'  => $data,
            'primary' => $this->primary,
            'id'    => (isset($id) ? $id : NULL)
        ));
        redirect('admin/user');
    }
    public function delete($id=NULL) {
        $user = $this->session->userdata('web_manager');
        //$super = $this->session->userdata('role');
        if($id == NULL) {
            $data = $this->input->post('cb', TRUE);
            if($user['role'] == '1' && $user['id'] != $id) 
                foreach($data as $value) 
                    //$this->admin_m->delete($this->table_name, $this->primary, $value);
                    $this->admin_model->delete(array(
                        'table'     => $this->table_name,
                        'key'       => $this->primary,
                        'value'     => $value
                    ));
        } else {
            if($user['role'] == '1' && $user['id'] != $id) 
                //$this->admin_m->delete($this->table_name, $this->primary, $id);
                $this->admin_model->delete(array(
                    'table'     => $this->table_name,
                    'key'       => $this->primary,
                    'value'     => $id
                ));
        }
        redirect($this->agent->referrer());
    }

    public function set_language() {
        $lang = $this->input->post('lang', TRUE);
        if($lang == NULL) {
            $lang = 'en';
        } 
        $ss_admin_lang = array(
            'ss_admin_lang' => $lang
        );
        $this->session->set_userdata($ss_admin_lang);
        $language = $this->session->userdata('ss_admin_lang');
        if($language == NULL) echo 'FALSE';
        else { 
            echo 'TRUE';
            //$this->load->library('user_agent');
            //redirect($this->agent->referrer());
        }
    }
}
