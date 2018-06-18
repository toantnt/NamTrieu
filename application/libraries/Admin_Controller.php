<?php

/**
 * Backend Controller
 */
class Admin_Controller extends MY_Controller {
    
    public $admin_lang;
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('security', 'language'));
        $this->load->model(array('account/account_model','admin/admin_model'));
		
		$webManager = $this->session->userdata('web_manager');
        $permision 	= $webManager['role'];
		//var_dump($permision);
        if (!isset($permision) && ($permision != "1" || $permision != "2")) {
            redirect(site_url('account/auth'));
        }
        //var_dump($permision); exit();
        $this->data['session_role'] = ($permision ==  '1' ? 'manager' : 'admin');
        $this->data['session_user'] = $webManager['username'];
        // Login check
        if (!isset($webManager['loggedin']) || ($webManager['loggedin'] == FALSE)) {
            redirect('account/auth'); // admin/auth
        }
        $lang = $this->session->userdata('ss_admin_lang');
        if($lang == null) {
            $this->admin_lang = 'en';
            $this->session->set_userdata(array('ss_admin_lang' => 'en'));
        } else {
            $this->admin_lang = $lang;
        }
    }

    public function ad_pagination($options, $links, $per_page) {
        $this->load->model('admin/admin_model');
        $this->load->library('pagination');

        $config['full_tag_open']    = '<ul class="pagination">';
        $config['full_tag_close']   = '</ul>';

        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';

        $config['cur_tag_open']     = '<li class="active"><a class="page-link">';
        $config['cur_tag_close']    = '</a></li>';

        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';

        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';

        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';

        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';

        $config['base_url']         = site_url($links);
        if(isset($_SERVER['QUERY_STRING'])) {
            $config['suffix']       = '?'.$_SERVER['QUERY_STRING'];
        }
        $config['total_rows']       = $this->admin_model->count($options);
        $config['per_page']         = $per_page;
        $this->pagination->initialize($config);
        $link = $this->pagination->create_links();

        return $link;
    }

}
