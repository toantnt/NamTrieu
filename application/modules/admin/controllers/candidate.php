<?php

/**
 * User manage
 */
class Candidate extends Admin_Controller {
	private $table_name = 'tbl_member';
    private $primary = 'member_id';

    function __construct() {
        parent::__construct();
        $this->load->model('admin/admin_model');
        $this->load->library('user_agent');
        $this->data['active'] = 'member';
        $this->data['sub_active'] = 'candidate';
    }

    public function index() {
        $this->data['subtitle'] = 'Quản lý ứng viên';
        $options = array(
            'table'  => $this->table_name,
            'order_by' => $this->primary.' DESC',
            'get_row' => false
        );
        $this->data['list'] = $this->admin_model->get($options);
        $this->data['subview'] = 'admin/candidate/index';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function add() {
        $this->data['query_string'] = $this->agent->referrer();
        $this->data['subtitle'] = 'Thêm ứng viên';
        $this->data['subview'] = 'admin/candidate/add';
        $this->load->view('admin/admin_layout', $this->data);
    }

    public function save() {
        $id = $this->input->post('member_id', TRUE);
        $data = $this->admin_model->array_from_post(array('member_name', 'member_email', 'member_phone', 'member_username','member_password', 'member_status'));
        $info = array(
        	'member_name' => $data['member_name'],
        	'member_username' => $data['member_username'],
        	'member_password' => $data['member_password']
        );

        if($data['member_status'] == NULL)
        {
        	$data['member_status'] = 0;
        } 
        if($data['member_password'] == NULL)
        {
        	unset($data['member_password']);
        } else {
        	$data['member_password'] = md5(md5($data['member_password']));
        }

        $values = array(
            'table' => $this->table_name,
            'data'  => $data,
            'primary' => $this->primary,
            'id'    => (isset($id) ? $id : NULL)
        );
        $saveid = $this->admin_model->save($values);
        $sending = $this->sendEmail($data, $info);
		//thuc hien gui
		if ( ! $sending )
		{
		    // Generate error
		    echo $this->email->print_debugger();
		}
        if ($saveid > 0 || $saveid == TRUE) {
            echo 'TRUE';
        } else {
            echo 'FALSE';
        }
    }
    public function edit($id) {
        $this->data['subtitle'] = 'Cập nhật thông tin';
        $this->data['query_string'] = $this->agent->referrer();
        $options = array(
            'table' => $this->table_name,
            'where' => array(
                $this->primary => (int) $id
            ),
            'get_row' => true
        );
        $this->data['id'] = $id;
        $this->data['candidate'] = $this->admin_model->get($options);
        $this->data['subview'] = 'admin/candidate/edit';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function checkUsername()
    {
    	$id = $this->input->post('id', TRUE);
    	$memberName = $this->input->post('username', TRUE);
    	$str_cmp = '';
    	if(isset($id)) {
    		$str = "(member_id != $id) AND (member_username='$memberName')";
    	}else {
    		$str = "member_username='$memberName'";
    	}
		$member = $this->account_model->get(array(
			'table' => $this->table_name,
			'where' => $str,
			'get_row' => true
		));
		
		if($member->member_username == null) {
    		echo json_encode(true);
    	} else {
    		echo json_encode(false);
    	}
		
    	
    }

    public function checkEmail()
    {
    	$id = $this->input->post('id', TRUE);
    	$memberMail = $this->input->post('email', TRUE);
    	if(isset($id)) {
    		$str = "(member_id != $id) AND (member_email='$memberMail')";
    	}else {
    		$str = "member_email='$memberMail'";
    	}
		$member = $this->account_model->get(array(
			'table' => $this->table_name,
			'where' => $str,
			'get_row' => true
		));
    	if($member->member_email == null) {
    		echo json_encode(true);
    	} else {
    		echo json_encode(false);
    	}
    }
    public function delete($id = NULL) {
        $super = $this->session->userdata('web_manager');
        if($super['role'] == '1') {
            if ($id == NULL) {
                $arr_id = $this->input->post('cb', TRUE);
                foreach ($arr_id as $item) {
                    $this->admin_model->delete(array(
                        'table' 	=> $this->table_name,
                        'key' 		=> $this->primary,
                        'value' 	=> $item
                    ));
                }
            } else {
                $this->admin_model->delete(array(
                    'table' 	=> $this->table_name,
                    'key' 		=> $this->primary,
                    'value' 	=> $id
                ));
            }
        }
        //$str = isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : '';
        redirect($this->agent->referrer());
    }

    public function sendEmail($data, $info) {
        $this->load->library('email');

        $options = $this->admin_model->get(array(
            'table'     => 'tbl_options',
            'where'     => array(
                'lang_code'  => $this->admin_lang
            ),
            'order_by'  => 'id DESC',
            'get_row'   => true
        ));
        // Cấu hình
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = $options->email_server;
        $config['smtp_port'] = $options->email_port;
        $config['smtp_user'] = $options->email; // change it to yours
        $config['smtp_pass'] = $options->email_password; // change it to yours
        $config['charset']   = 'utf-8';
        $config['newline']   = '\r\n';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $this->email->from($options->email, 'Tuyển dụng Nam Triều');
        $this->email->to($data['member_email']);

        $body = $this->load->view('admin/candidate/email.php',$info,TRUE);
        $this->email->subject('Thông tin tài khoản');
        $this->email->message($body);

        return $this->email->send();


//        $this->load->library('email');
//        // Cấu hình
//        $config['protocol'] = 'smtp';
//        $config['smtp_host'] = 'ssl://smtp.gmail.com';
//        $config['smtp_port'] = 465;
//        $config['smtp_user'] = 'loanntb.jvb@gmail.com'; // change it to yours
//        $config['smtp_pass'] = 'snowangle'; // change it to yours
//        $config['charset'] = 'utf-8';
//        $config['newline']    = '\r\n';
//        $config['mailtype'] = 'html';
//        $config['wordwrap'] = TRUE;
//        $this->email->initialize($config);
//        $this->email->set_mailtype("html");
//        $this->email->set_newline("\r\n");
//
//        $this->email->from('loanntb.jvb@gmail.com', 'Nguyen Thi Bich Loan');
//        $this->email->to($data['member_email']);
//
//        $body = $this->load->view('admin/candidate/email.php',$info,TRUE);
//        $this->email->subject('Thông tin tài khoản');
//        $this->email->message($body);

          //dinh kem file
          //$this->email->attach('/path/to/photo1.jpg');

    }
}