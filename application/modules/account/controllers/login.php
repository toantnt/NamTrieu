<?php

class Login extends Frontend_Controller {
    private $table = 'tbl_member';
    private $id    = 'member_id';
    function __construct()
    {
        parent::__construct();
        $this->load->model('home/home_model');
    }

    public function index() {
        $this->data['subtitle'] = lang('login');
        $this->data['subview']  = 'account/login/index';

        $this->load->view('home/layout', $this->data);
    }

    public function loggedIn() {
        $user = $this->home_model->array_from_post(array(
            'email', 'password'
        ));

        $member = $this->home_model->get(array(
            'table'     => $this->table,
            'where'     => array(
                'member_email'  => $user['email'],
                'member_password'  => md5(md5(md5($user['password'])))
            ),
            'get_row'   => true
        ));
        if ($member->member_id != NULL) {
            $data = array(
                'name'          => $member->member_name,
                'username'      => $member->member_username,
                //'ad_image'    => $member->user_image,
                'member_id'     => $member->member_id,
                'member_type'   => $member->member_type,
                'loggedin'      => TRUE
            );
            $this->session->set_userdata('namtrieu_member', $data);
            $urlMember = '';
            if($member->member_type == 1) {
                $urlMember = '/'.$this->web_lang.'/candidate/profile';
            } else {
                $urlMember = '/'.$this->web_lang.'/company/profile';
            }

            echo json_encode(array(
                'success' => true,
                'url' => $urlMember
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'url' => ''
            ));
        }
    }

    public function checkEmail() {
        $email = $this->input->post('email', TRUE);
        $check = $this->home_model->get(array(
            'table'     => $this->table,
            'where'     => array(
                'member_email'  => $email
            ),
            'get_row'   => true
        ));
        if($check->member_email != NULL) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

    public function checkPassword() {
        $pass = $this->input->post('password', TRUE);
        $check = $this->home_model->get(array(
            'table'     => $this->table,
            'where'     => array(
                'member_password'  => md5(md5(md5($pass)))
            ),
            'get_row'   => true
        ));
        if($check->member_username != NULL) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
}