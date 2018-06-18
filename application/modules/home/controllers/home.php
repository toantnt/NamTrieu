<?php

/**
 * DEFAULT CONTROLLER
 */
class Home extends Frontend_Controller {

	private $lang;

    function __construct() {
        parent::__construct();
    	$this->load->model('home/home_model');
        $this->lang = ($GLOBALS['lang_code'] == null ? 'en' : $GLOBALS['lang_code']);
    }

    public function index() {
    	$this->data['vi_url'] = 'vi';
    	$this->data['en_url'] = 'en';
        $this->data['subtitle'] = ($this->lang == 'en' ? 'Home' : 'Trang chủ');
        $options = array(
            'table' => 'tbl_slide',
            'where' => array(
                'lang_code' => $this->lang 
            ),
            'get_row'  => false,
            'order_by' => 'slide_id ASC',
            'total'    => 7,
        );
        $this->data['slide'] 	  = $this->home_model->get($options);
        
        $this->data['subview'] 	= 'home/home/index';
        $this->load->view('home/layout', $this->data);
    }

    public function about() {
        $this->data['subtitle'] = ($GLOBALS['lang_code'] == 'vi' ? 'Giới thiệu' : 'About Us');
        $this->data['about']    = $about = $this->home_model->get(array(
            'table'     => 'tbl_post',
            'where'     => array(
                'c_id'  => ($GLOBALS['lang_code'] == 'vi' ? 16 : 13),
                'lang_code' => $GLOBALS['lang_code']
            ),
            'order_by'  => 'c_id DESC',
            'get_row'   => true
        ));
        // for switch languge
        $this->data['vi_url'] = 'vi/gioi-thieu';
        $this->data['en_url'] = 'en/about-us';
        $team = $this->home_model->get(array(
            'table'     => 'tbl_post_cat',
            'select' 	=> 'c_id, c_name, c_slug',
            'where'     => array(
                'c_id'  => ($GLOBALS['lang_code'] == 'vi' ? 17 : 15),
                'lang_code' => $GLOBALS['lang_code']
            ),
            'order_by'  => 'c_id DESC',
            'get_row'   => true
        ));
        $this->data['ourTeam'] = $team;
        $this->data['personal']= $this->home_model->get(array(
            'table'     => 'tbl_post',
            'where'     => array(
                'c_id'  => ($GLOBALS['lang_code'] == 'vi' ? 17 : 15),
                //'lang_code' => $GLOBALS['lang_code']
            ),
            'order_by'  => 'post_id ASC',
            'get_row'   => false
        ));
        $this->data['subview'] = 'home/home/intro';
        $this->load->view('home/layout_page', $this->data);
    }

    public function persons($slug) {
        $person = $this->home_model->get(array(
            'table'     => 'tbl_post',
            'where'     => array(
                'post_slug' => strip_tags($slug),
                'lang_code' => $GLOBALS['lang_code']
            ),
            'order_by'  => 'post_id DESC',
            'get_row'   => true
        ));
        $this->data['subtitle'] = $person->post_name;
        $this->data['list'] = $this->home_model->get(array(
            'table'     => 'tbl_post',
            'where'     => array(
                'c_id'  => ($GLOBALS['lang_code'] == 'vi' ? 17 : 15),
                //'lang_code' => $GLOBALS['lang_code']
            ),
            'order_by'  => 'post_id ASC',
            'get_row'   => false
        ));

        $this->data['subview'] = 'home/home/persons';
        $this->load->view('home/layout_page', $this->data);
    }

    public function send_contact() {
        $values = $this->home_model->array_from_post(array(
            'your_name', 'your_phone', 'your_email',
            'your_company', 'your_title', 'your_request'
        ));
        $infor = null; /*$this->home_model->get(tbl_app, array(
            'where' => "lang_code='en'",
            'get_row' => true
        ), 'id');*/

        $subject = ($values['your_title'] == null ? 'Contact from '.$infor->site_name : $values['your_title']. ' - Via '.$infor->site_name);
        $message = '<p>Partner name: <strong>'.$values['your_name'].'</strong></p>';
        if($values['your_phone'] != null) {
            $message .= '<p>Phone number: <strong>'.$values['your_phone'].'</strong></p>';
        }
        if($values['your_company'] != null) {
            $message .= '<p>Company: <strong>'.$values['your_company'].'</strong></p>';
        }
        if($values['your_company'] != null) {
            $message .= '<p>Your title: <strong>'.$values['your_title'].'</strong></p>';
        }
        $message .= '<p>__________________________</p><p></p>';
        $message .= $values['your_request'];
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = $infor->email_server;
        $config['smtp_port'] = $infor->email_port;//"465"
        $config['smtp_user'] = $infor->email; 
        $config['smtp_pass'] = $infor->email_password;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $ci->email->initialize($config); 

        $ci->email->from($data_user['email'], $values['your_name']);
        $list = array($infor->email, $values['your_email']);
        $ci->email->to($list);
        $ci->email->subject($subject);
        $ci->email->message($message);
        $ci->email->send();
        echo 'TRUE';

    }

}
