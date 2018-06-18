<?php 
	
class Account extends Frontend_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('home/home_model');
		$this->load->library('user_agent');
	}
	
	public function index() {
        $this->data['en_url'] = 'en/account';
        $this->data['vi_url'] = 'vi/tai-khoan';
		$member = $this->session->userdata('lapham_member');
		if($member['member_id'] == NULL) {
			$this->session->unset_userdata('lapham_member');
			$this->data['subtitle'] = ($GLOBALS['lang_code'] == 'vi' ? 'Đăng nhập' : 'Login');
			$this->data['subview'] 	= 'home/account/auth';
		} else {
			$this->data['profile'] 	= $profile = $this->home_model->get(array(
				'table' 	=> 'tbl_member',
				'where' 	=> array(
					'member_id' => $member['member_id'] 
				),
				'order_by'	  => 'member_id DESC',
				'get_row' 	  => true
			));
			$this->data['subtitle'] = $profile->member_name;
			$this->data['subview'] 	= 'home/account/dashboard';
		}

		$this->load->view('home/layout_page', $this->data);
		
	}
	public function orders()
	{
		$member = $this->session->userdata('lapham_member');
		$this->check_member($member);
		$this->data['en_url'] = 'en/account/invoices';
        $this->data['vi_url'] = 'vi/tai-khoan/lich-su-thanh-toan';

		$this->data['subtitle'] = ($GLOBALS['lang_code'] == 'vi' ? 'Đơn hàng của bạn' : 'Invoices'); 

		$this->data['list']	= $this->home_model->get(array(
			'table'		=> 'bill_customer',
			'where'		=> array(
				'member_id'	=> $member['member_id']
			),
			'order_by'	=> 'bill_id DESC',
			'get_row'	=> false
		)); 
		$this->data['subview']  = 'home/account/orders';
		$this->load->view('home/layout_page', $this->data);
	}

	public function printOrder($id) {
		$this->data['myOrder'] = $this->home_model->get(array(
			'table'		=> 'bill_customer',
			'where'		=> array(
				'bill_id'	=> $id
			),
			'get_row'	=> true
		));
	}
	
	public function access() {
		$member  = $this->session->userdata('lapham_member');
		$this->check_member($member);
		$this->data['en_url'] = $link_en = 'en/account/access';
		$this->data['vi_url'] = $link_vi = 'vi/tai-khoan/truy-cap';

		$this->data['profile']= $profile = $this->home_model->get(array(
			'table' 	=> 'tbl_member',
			'where' => array(
				'member_id' => $member['member_id'] 
			),
			'order_by'	  => 'member_id DESC',
			'get_row' 	  => true
		));

		if($_POST['new_email']) {
			$this->home_model->save(array(
				'table'   => 'tbl_member',
				'data'	  => array(
					'member_email' => $_POST['new_email']
				),
				'primary'	=> 'member_id',
				'id'		=> $profile->member_id
			));
			redirect(($GLOBALS['lang_code'] == 'en' ? $link_en : $link_vi), 'refresh');
		}

		if($_POST['new_pass']) {
			$newPass = md5(md5($_POST['new_pass']));
			$this->home_model->save(array(
				'table'   => 'tbl_member',
				'data'	  => array(
					'member_password' => $newPass
				),
				'primary'	=> 'member_id',
				'id'		=> $profile->member_id
			));
			redirect(($GLOBALS['lang_code'] == 'en' ? $link_en : $link_vi), 'refresh');
		}
		
		$this->data['subtitle'] = $this->lang->line('access_detail'); 
		$this->data['subview']  = 'home/account/access';
		$this->load->view('home/layout_page', $this->data);
	}

	public function login_account() {
		$values = $this->home_model->array_from_post(array(
            'nicename', 'password' 
        ));
        $check1 = $this->input->post('check1', TRUE);
	    $check2 = $this->input->post('check2', TRUE);
	    if(($check1 == 1 || $check1== NULL) && ($check2 == NULL)) { 
	        $user = $this->home_model->get(array(
	        	'table' 		=> 'tbl_member',
	        	'where' 	=> array(
		        	'member_nicename' => $values['nicename'],
		        	'member_password' => md5(md5($values['password']))
	        	),//"(member_nicename='".."') AND (member_password='".."')",
	            'get_row' 	=> true
	    	));
	        
	        if ($user->member_id != NULL) {	
	            $data = array(
	                'name' 		=> $user->member_name,
	                'username' 	=> $user->member_nicename,
	                //'ad_image' => $user->user_image,
	                'member_id' => $user->member_id,
	                'loggedin' 	=> TRUE
	            );
	            $this->session->set_userdata('lapham_member', $data);
	        }
	        $link = ($GLOBALS['lang_code'] == 'en' ? $GLOBALS['lang_code'].'/account' : $GLOBALS['lang_code'].'/tai-khoan');
	        redirect($link);
	    } else {
	    	redirect($GLOBALS['lang_code'].'/forgot');
	    }
	}
    public function save_session()
    {
	    $values = $this->home_model->array_from_post(array(
            'member_name', 'member_email', 'member_phone', 'member_nicename',
            'member_address', 'member_state', 'member_postal_code', 'member_national' 
        ));
        if($values['member_name'] == NULL || $values['member_email'] == NULL || $values['member_nicename'] == NULL || $values['member_postal_code'] == NULL) {
	        redirect($GLOBALS['lang_code'].'/account');
		} else {
			$this->session->unset_userdata('lapham_member');
			$this->session->set_userdata('lapham_member', $values);
			redirect($GLOBALS['lang_code'].'/account/register');
		}
	            
    }

    public function register()
    {
        $this->data['subtitle'] = $this->lang->line('register_account');
        $this->data['member']   = $this->session->userdata('lapham_member');
        
        $values = $this->session->userdata('lapham_member');
        $check = $this->home_model->get(array(
	        'table'		=> 'tbl_member',
	        'where'		=> "(member_nicename='".$values['member_nicename']."') OR (member_email='".$values['member_email']."')",
	        'get_row'	=> true
        ));
        $this->data['account']  = $check;
        $this->data['subview']  = 'home/account/register';
        $this->load->view('home/layout_page', $this->data);
    }


	public function save() {
        $values = $this->session->userdata('lapham_member');
        $password = $this->input->post('member_password', TRUE);
        
        $this->home_model->save(array(
        	'table'	=> 'tbl_member',
        	'data'	=> array(
	        	'member_name' 		=> $values['member_name'],
	        	'member_email' 		=> $values['member_email'],
	        	'member_phone' 		=> $values['member_phone'],
	        	'member_nicename' 	=> $values['member_nicename'],
	        	'member_password' 	=> md5(md5($password)),
	        	'member_address' 	=> $values['member_address'],
	        	'member_state' 		=> $values['member_state'],
	        	'member_postal_code'=> $values['member_postal_code'],
	        	'member_national' 	=> $values['member_national'],
	        	'member_status' 	=> 1
        	),
        	'primary' 	=> 'member_id',
        	'id'		=> NULL
        ));
        //var_dump($values);
        redirect($GLOBALS['lang_code'].'/account/finish');
    }
    
    public function finish() {
	    $this->data['subtitle'] = $this->lang->line('thank_for_register');
	    $this->data['member']   = $this->session->userdata('lapham_member');
	    $this->data['subview'] 	= 'home/account/finish';
	    $this->load->view('home/layout_page', $this->data);
	    $this->session->unset_userdata('lapham_member');
    }

    public function update()
    {
	    date_default_timezone_set("Asia/Ho_Chi_Minh");
        $id = $this->input->post('member_id', TRUE);
        
        $values = $this->home_model->array_from_post(array(
            'member_name', 'member_email', 'member_phone', 'member_nicename',
            'member_address', 'member_state', 'member_postal_code', 'member_national',
            'member_birth'
        ));
        if($values['member_password'] != NULL) {
            $values['member_password'] = md5(md5($values['member_password']));
        } else {
            unset($values['member_password']);
        }
        $values['member_birth'] = date('Y-m-d', strtotime($values['member_birth']));

        $rs = $this->home_model->save(array(
        	'table' => 'tbl_member',
        	'data'	=> $values,
        	'primary' => 'member_id',
        	'id'	=> $id
        )); 
        if($rs != 0) {
        	$url = ($GLOBALS['lang_code'] == 'vi' ? $GLOBALS['lang_code'].'/tai-khoan' : $GLOBALS['lang_code'].'/account'); 
            redirect($url, 'refresh');
        } else {
            echo $rs;
        }
    }

    public function check_username() {
	    $username 	= $this->input->post('member_nicename', true);
        $check 		= $this->home_model->get(array(
            'table' 	=> 'tbl_member',
            'where' 	=> "member_nicename='$username'",
            'get_row' 	=> true,
            'order_by' 	=> 'member_id ASC'
        ));
        if($check->member_nicename != NULL) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }
    
    public function check_email() {
	    $email 		= $this->input->post('member_email', true);
        $check 		= $this->home_model->get(array(
            'table' 	=> 'tbl_member',
            'where' 	=> "member_email='$email'",
            'get_row' 	=> true,
            'order_by' 	=> 'member_id ASC'
        ));
        if($check->member_email != NULL) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function forgot() {
	    $this->data['en_url'] = 'en/forgot';
	    $this->data['vi_url'] = 'vi/forgot';
        $username = $this->session->userdata('username');
        if($username != NULL) {
            redirect('profile');
        }
        $this->data['subtitle'] = $this->lang->line('forgot_pass');
        $this->data['subview'] = 'home/account/forgot';
        $this->load->view('home/layout_page', $this->data);
    }
    public function reset_password() {
	    $member  = $this->input->post('member_email', true);
	    $account = $this->home_model->get(array(
		    'table' 		=> 'tbl_member',
		    'where'		=> array(
			    'member_email' => $member
		    ),
		    'get_row' 	=> true
	    ));
	    if($account->member_id != NULL) {
		    $this->home_model->save(array(
			    'table' 		=> 'tbl_member',
			    'data'		=> array(
				    'member_password' => md5(md5('123456'))
			    ),
			    'primary'	=> 'member_id',
			    'id'		=> $account->member_id
		    ));
	    } 
	    $this->data['subtitle']	= $this->lang->line('reset_success');
	    $this->data['account'] = ($account->member_id == NULL ? NULL : $account);
	    $this->data['subview'] = 'home/account/reset_password';
	    $this->load->view('home/layout_page', $this->data);

    }
    public function check_member($member)
    {
    	//$member = $this->session->userdata('lapham_member');
    	if(!isset($member) || $member == NULL) {
    		$url = ($GLOBALS['lang_code'] == 'en' ? 'en/account' : 'vi/tai-khoan');
    		redirect($url);
    	}
    }
    public function logout() {
    	$this->session->unset_userdata('lapham_member');
        //$this->session->sess_destroy();
        redirect(site_url());
    }
	
}