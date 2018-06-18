<?php

class Register extends Frontend_Controller {
    private $table = 'tbl_member';
    private $id    = 'member_id';

    function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function index() {
        $this->data['subtitle'] = lang('register');
        $this->data['subview']  = 'account/register/index';
        $this->load->view('home/layout', $this->data);
    }

    public function saveData() {
        $values = $this->home_model->array_from_post(array(
            'email', 'username', 'password', 'phone', 'member_type'
        ));
        //var_dump($values); exit();
        $insertId = $this->home_model->save(array(
            'table' => $this->table,
            'data'  => array(
                'member_email'    => $values['email'],
                'member_username' => $values['username'],
                'member_password' => md5(md5(md5($values['password']))),
                'member_phone'    => $values['phone'],
                'member_type'     => $values['member_type']
            ),
            'primary'   => $this->id,
            'id'        => NULL
        ));
        if($insertId > 0) {
            echo 'TRUE';
        } else {
            echo 'FALSE';
        }
    }

    public function captcha() {
        $cap = $this->createCaptcha('registerCaptcha');
        echo $cap;
    }

    public function checkCaptcha() {
        $captcha = $this->input->post('register_captcha', TRUE);
        $ss_captcha = $this->session->userdata('registerCaptcha');
        if($captcha == $ss_captcha) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

    public function checkUsername() {
        $username = $this->input->post('username', TRUE);
        $check = $this->home_model->get(array(
            'table'     => $this->table,
            'where'     => array(
                'member_username'  => $username
            ),
            'get_row'   => true
        ));
        if($check->member_username == NULL) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
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
        if($check->member_email == NULL) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
}