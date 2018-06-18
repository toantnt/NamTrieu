<?php


class Auth extends MY_Controller {

	private $_table = 'tbl_user';

	function __construct() {
		parent::__construct();
		$this->load->model('account/account_model');
		if(isset($session_user) && $session_role <= 2) {
			redirect('admin');
		} 
	}

	public function index() {
		

		$this->data['subtitle'] = 'Đăng nhập hệ thống';
		$this->data['subview'] 	= 'account/auth/index';
		$this->load->view('account/layout', $this->data);
	}

	public function login() {
		$values = array(
			'username' => $this->input->post('username', TRUE),
			'password' => $this->input->post('password', TRUE)
		);
		$remember = (int) $this->input->post('remember_me', TRUE);
		$user = $this->account_model->login($values);
		//var_dump($user); die();
		//$this->session->set_userdata('web_manager', $user);
		//$us = $this->session->userdata('web_manager');
		//var_dump($us); die();
		if($user['loggedin']) {
			if($remember == 1) {
				setcookie('admin', $user['username'], time() + 7200, "/");
				$this->session->set_userdata('web_manager', $user);
			} else {
				$this->session->set_userdata('web_manager', $user);
			}
			echo 'TRUE';
			//redirect(site_url('admin/dashboard'));
		} else {
			echo 'FALSE';
		}

	}

	public function checkUsername() {
		$username = $this->input->post('username', TRUE);
		$user = $this->account_model->get(array(
			'table' => $this->_table,
			'where' => array(
				'user_username' => $username
			),
			'get_row' => true
		));
		if(isset($user->user_username)) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
	}
	public function checkPassword() {
		$password = $this->input->post('password', TRUE);
		$user = $this->account_model->get(array(
			'table' => $this->_table,
			'where' => array(
				'user_password' => md5(md5($password))
			),
			'get_row' => true
		));
		if(isset($user->user_username)) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
	}

	public function checkEmail() {
		$email = $this->input->post('email', TRUE);
		$user = $this->account_model->get(array(
			'table' => $this->_table,
			'where' => array(
				'user_email' => $email
			),
			'get_row' => true
		));
		if(isset($user->user_id)) {
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
	}

	public function send_pass() {
		$email = $this->input->post('email', TRUE);
		$randomPass = $this->randomString(8);
	}

	public function logout() {
		$this->session->sess_destroy();
		setcookie("admin", '', time()-3600, "/");
		//unset($_COOKIE["admin"]);
		redirect(site_url());
	}

	public function forgot() {
		$this->data['subtitle'] = 'Quên mật khẩu';
		$this->data['subview'] 	= 'account/auth/forgot';
		$this->load->view('account/layout', $this->data);
	}
}