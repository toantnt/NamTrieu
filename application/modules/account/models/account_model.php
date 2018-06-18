<?php 

class Account_Model extends MY_Model {

	private $_table = 'tbl_user';

	function __construct() {
		parent::__construct();
		$this->load->helper('cookie');
	}

	public function login($data) {
		$admin = $this->get(array(
			'table' => $this->_table,
			'where' => array(
				'user_username' => $data['username'],
				'user_password' => md5(md5($data['password']))
			),
			'get_row' => true
		));

		if(isset($admin->user_username) && ($admin->user_role <= 2)) {
			$return = array(
				'name' 		=> $admin->user_firstname.' '.$admin->user_lastname,
                'username' 	=> $admin->user_username,
                'role' 		=> $admin->user_role,
                'id' 		=> $admin->user_id,
                'loggedin' 	=> TRUE
			);
			return $return;
		} else {
			$return = array('loggedin' => FALSE);
			return $return;
		}

	}
	public function loggedin() {
		$user_admin = $_COOKIE['admin'];
		if(isset($user_admin)) {
			$ss_user = $this->session->userdata('web_manager');
			if(!isset($ss_user['id']) || $ss_user['id'] == NULL) {
				$admin = $this->get(array(
					'table' => $this->_table,
					'where' => array(
						'user_username' => $user_admin,
					),
					'get_row' => true
				));
				$ss_reload = array(
					'name' 		=> $admin->user_firstname.' '.$admin->user_lastname,
	                'username' 	=> $admin->user_username,
	                'role' 		=> $admin->user_role,
	                'id' 		=> $admin->user_id,
	                'loggedin' 	=> TRUE
				);
				$this->session->set_userdata($ss_reload);
			}
			return TRUE;
		} else {
			$ss_user = $this->session->userdata('web_manager');
			return (bool) $$ss_user['loggedin'];
		}
	}
}