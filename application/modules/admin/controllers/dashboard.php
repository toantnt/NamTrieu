<?php 

class Dashboard extends Admin_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('admin/admin_model');
		//$this->session->sess_destroy();
		$this->data['active'] = 'dashboard';
		$this->data['sub_active'] = '';
	}

	public function index() {
		$this->data['subtitle'] = 'Dashboard';
		//var_dump($_COOKIE['admin']);
		//var_dump($this->account_model->loggedin());
		$this->data['post']		= $this->list_post();
		$this->data['orders'] 	= $this->list_order();
		$this->data['users'] 	= $this->list_member();

		$this->data['subview'] 	= 'admin/dashboard/index';
		$this->load->view('admin/admin_layout', $this->data);
	}

	public function list_post() {
		return 0;
	}

	public function list_order() {
		return 0;
	}
	public function list_member()
	{
		return 0;
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
        }
    }
}