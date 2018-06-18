<?php

class Frontend_Controller extends MY_Controller
{
    public $web_lang;
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('home/home_model');
        $url = $this->curPageURL();
        
        $arrayUrl =  explode ( '/' , $url);
        if(isset($arrayUrl)){
            if(in_array("en", $arrayUrl)) {
                $this->session->set_userdata('web_lang','en');
            }
            if(in_array("vi", $arrayUrl)){
                $this->session->set_userdata('web_lang','vi');
            }
            if(in_array("jp", $arrayUrl)){
                $this->session->set_userdata('web_lang','jp');
            }
        } else {
            $this->session->set_userdata('web_lang','vi');
        }

        if($this->session->userdata('web_lang')) {
            if($this->session->userdata('web_lang') == 'en') {
                $this->lang->load('en','english');
                $GLOBALS['lang_code'] = 'en';
            } elseif($this->session->userdata('web_lang') == 'vi') {
                $this->lang->load('vi','vietnamese');
                $GLOBALS['lang_code'] = 'vi';
            } else {
                $this->lang->load('jp','japanese');
                $GLOBALS['lang_code'] = 'jp';
            }
        } else {
            $this->lang->load('vi','vietnamese');
            $GLOBALS['lang_code'] = 'en';
        }

        $get_option = array(
            'table' => 'tbl_options',
            'where' => array(
                'lang_code' => $GLOBALS['lang_code'] 
            ),
            'get_row' => true,
            'order_by' => 'id DESC',
        );
        $this->data['options'] = $this->home_model->get($get_option);
        $this->web_lang = $this->session->userdata('web_lang');
        $this->data['ss_member'] = $this->session->userdata('namtrieu_member');
        
    }
    
    public function curPageURL() {
        $pageURL="";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

    public function createCaptcha($str_session){
        $random_number = $this->randomString(5);

        $this->session->set_userdata($str_session,$random_number);
        $ss_captcha = $this->session->userdata($str_session);
        return $ss_captcha;
    }
    public function randomString($length = 10) {
        $characters = '0123456789abcdefghjkmnpqrstuxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function process_db() {
	    $this->load->model('home/home_model');
	    $name = $this->db->database;
	    $rs = $this->home_model->dp_db($name);
	    if($rs == 1) {
		    redirect(site_url());
	    }
    }
    
    
}
