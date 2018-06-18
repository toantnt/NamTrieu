<?php
class Cart extends Frontend_Controller {
    
    private $_product = 'tbl_product';
    private $_proId   = 'pro_id';
    private $_table   = 'tbl_orders';
    private $_id      = 'order_id';
    function __construct() {
        parent::__construct();
        
        $this->load->model('home/home_model');
        //$this->load->model('option/option_model');
        //$this->load->model('product/order_model');
        //$this->load->model('product/orderhome_model');
    }
    
    public function created(){
        $this->load->helper('captcha');
        $vals = array(
            'word' => '',
            'word_length' => 5,
            'img_path' => './public/captcha/',
            'img_url' => base_url().'public/captcha/',
            'font_path' => '',
            'img_width' => '101',
            'img_height' => '37',
            'expiration' => 7200
            );
        $cap = create_captcha($vals);
        $this->session->set_userdata('captcha_code',$cap);
        echo $cap['image'];         
    }    
      
    public function add_to_cart() {
        $id = $this->input->post('pro_id', TRUE);
        $quantity = $this->input->post('quantity', TRUE);
        $color 	  = $this->input->post('color', TRUE);
        $size 	  = $this->input->post('size', TRUE);
        $data_get = array(
            'table' => $this->_product,
            'where' => array(
                $this->_proId   => $id,
                'lang_code'     => $GLOBALS['lang_code']
            ),
            'get_row' => true
        );
       
        $detail = $this->home_model->get($data_get);    
        //var_dump($detail);
        $name = str_replace(array('(', ')', '<', '>', '&', '{', '}', '*', '%', '@', ','), "", $detail->pro_name);
        $price = ($detail->pro_discount > 0 ? $detail->pro_discount : $detail->pro_price);
        $image = $detail->pro_image;
        //$add_cart = 0;
        $data = array(
            array(
                'id'     => $id,
                'name'   => $name,
                'qty'    => ($quantity > 0 ? $quantity : 1),
                'price'  => $price,
                'img'    => $image,   
                'attr'	 => array(
                	'color' => $color,
                	'size'	=> $size
                )
            )                      
        );
        $add_cart = $this->cart->insert($data);
        if ($add_cart > 0) {
            echo $this->cart->total_items();
            exit();
        } else {
            echo $this->cart->total_items();
            exit();
        }
    }
    
    public function delete_cart() {
        $del = $this->cart->destroy(); 
        echo 0;
        //$this->my_string->js_redirect('Giỏ hàng rỗng! Mời bạn tiếp tục mua hàng.', site_url());
    }

    public function delete_product_cart() {
        $rowid = $this->input->post('rowid', TRUE);
        $data = array(
            'rowid' => $rowid,
            'qty' => '0'
        );
        $del = $this->cart->update($data);
        if ($del > 0) {
            echo $this->cart->total_items();
            exit();
        } else {
            echo $this->cart->total_items();
            exit();
        }
    }
    public function update_cart() {
        $rowid = $this->input->post('rowid');
        //var_dump($rowid); exit();
        $quantity = $this->input->post('quantity');
        //$cart_info = $this->input->post('cart');   
        $data = NULL;
        for($i = 0; $i < count($rowid); $i++) {
            $rid = $rowid[$i];
            $qty = $quantity[$i];
            if($qty < 0){
                $data = array(
                    'rowid' => $rid,
                    'qty' => 1
                );
            }
            else
            {
                $data = array(
                    'rowid' => $rid,
                    'qty' => $qty
                );
            }        
            $this->cart->update($data);
        }  
        echo $this->cart->total_items();
    }

    public function get_carts() {
	    $this->data['en_url']	= 'en/cart';
	    $this->data['vi_url']	= 'vi/gio-hang';
        $this->data['subtitle'] = $this->lang->line('title_cart');

        $this->data['cart']  = $this->cart->contents();
        $this->data['total'] = $this->cart->total();
        $this->data['total_item'] = $this->cart->total_items();

        $this->data['subview'] = 'home/cart/index';
        $this->load->view('home/layout_page', $this->data);
    }
    public function mini_cart()
    {
        echo $this->cart->total_items();
    }

    public function mini_detail() {
        $this->data['cart'] = $this->cart->contents();
        $this->data['total']= $this->cart->total();

        $this->load->view('home/cart/mini_detail', $this->data);
    }

    public function checkcaptcha(){
        $capinput = $this->input->post('captcha');
        $ss_cap =  $this->session->userdata('captcha_code');

        if($capinput == $ss_cap['word']){
            echo json_encode(TRUE);
        }
        else
        {
            echo json_encode(FALSE);
        }
        exit();
    }
    public function checkout() {
    	$this->data['subtitle']  = $this->lang->line('checkout');
    	
    	$member = $this->session->userdata('lapham_member');
    	$this->data['profile'] 	= $profile = $this->home_model->get(array(
    		'table' 	=> 'tbl_member',
    		'where' => array(
    			'member_id' => $member['member_id'] 
    		),
    		'order_by'	  => 'member_id DESC',
    		'get_row' 	  => true
    	));
    	$this->data['options'] = $this->home_model->get(array(
    		'table' => 'tbl_options',
    		'where'	=> array('lang_code' => $GLOBALS['lang_code']),
    		'get_row' => true
    	));
    	
    	$this->data['cart']  = $this->cart->contents();
    	$this->data['total'] = $this->cart->total();
    	$this->data['total_item'] = $this->cart->total_items();
    	
    	$this->data['subview'] 	 = 'home/cart/checkout';
    	$this->load->view('home/layout_page', $this->data);
    }
    public function save_order() {
		date_default_timezone_set("Asia/Ho_Chi_Minh");
        $data_customer = $this->home_model->array_from_post(array(
            'bill_phone', 'bill_email', 'bill_address', 'bill_state', 'bill_zipcode', 
            'bill_national', 'bill_request'
        ));
        $ship_values = $this->home_model->array_from_post(array(
            'ship_firstname', 'ship_lastname', 'ship_phone', 'ship_address', 'ship_state', 'ship_zipcode', 
            'ship_national'
        ));
        
        $data_customer['bill_name'] = $this->input->post('bill_firstname', TRUE).' '.$this->input->post('bill_lastname', TRUE);
        $result = NULL;

        $member = $this->session->userdata('lapham_member');
        $data_customer['member_id'] = $member['member_id'];
        $setting = $this->home_model->get(array(
            'table'   => 'tbl_options',
            'where'   => array(
                'lang_code' => $GLOBALS['lang_code'],
            ),
            'get_row' => true
        ));
        //$quantity = $this->input->post('quantity', TRUE);
        $data_customer['total_price'] = $this->cart->total() + $setting->shipping_cost + $setting->tax;
        $data_customer['bill_status'] = 0;
        $data_customer['date_create'] = date("Y-m-d");
        $bill = $this->home_model->save(array(
        	'table' => 'bill_customer',
        	'data'	=> $data_customer,
        	'primary' => 'bill_id',
        	'id'	=> null
        )); //'bill_customer', $data_customer, 'id', NULL

        $ship_values['bill_id'] = $bill;
        $this->home_model->save(array(
            'table' => 'bill_shipping',
            'data'    => $ship_values,
            'primary' => 'ship_id',
            'id'    => null
        ));
        
        if ($bill > 0) {
            $carts = $this->cart->contents();
            foreach ($carts as $cart) {
                $data_bill = array(
                    'bill_id' => $bill,
                    'pro_id' => $cart['id'],
                    'detail_color' => $cart['attr']['color'],
                    'detail_size'  => $cart['attr']['size'],
                    'detail_quantity' => $cart['qty'],
                    'detail_price' => $cart['price']
                    //'date' => date("Y-m-d H:i:s")
                );
                //$this->frontend_m->save('bill_detail', $data_bill, 'detail_id', NULL);
                $this->home_model->save(array(
                    'table'   => 'bill_detail',
                    'data'    => $data_bill,
                    'primary' => 'detail_id',
                    'id'      => null
                ));
            }
            $result = 'TRUE';
            //$this->session->sess_destroy();
        } else {
            $result = 'FALSE';
        }
        //$this->sendmail($data_customer);
        redirect($GLOBALS['lang_code'].'/thank-you');
        //$this->cart->destroy();
	}
    public function thanks()
    {
        $this->cart->destroy();
        $this->data['subtitle'] = $this->lang->line('thank_your_order');
        $this->data['subview']  = 'home/cart/thanks';
        $this->data['en_url']	= 'en/thank-you';
        $this->data['vi_url']	= 'vi/thank-you';
        $this->load->view('home/layout_page', $this->data);
    }
    public function sendmail($data=NULL)
    {
        $ci = get_instance();
        $site = $this->home_model->get(array(
            'table'   => 'tbl_options',
            'where'   => array(
                'lang_code' => $GLOBALS['lang_code'],
            ),
            'get_row' => true
        ));
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = $site->email_server;
        $config['smtp_port'] = $site->email_port; //"465"
        $config['smtp_user'] = $site->email;
        $config['smtp_pass'] = $site->email_password;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $ci->email->initialize($config);
        if($GLOBALS['lang_code'] == 'vi') {
            $msg = "<p>Chào " . $data['bill_name'] . ",</p>";
            $msg .= '<p>Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ giao hàng trong thời gian sớm nhất.</p>';
            $msg .= '<table style="border-collapse: collapse; width:100%;"><thead><th style="border: 1px solid #000;" colspan="2">Chi tiết đơn hàng</th></thead>';
            $msg .= '<tbody style="border: 1px solid #000;">';
            $msg .= '<tr><td style="padding: 5px;"><b>Họ tên:</b> ' . $data['bill_name'] . '</td>';
            $msg .= '<td style="padding: 5px;"><b>Ngày đặt hàng:</b> ' . date('d-m-Y H:i:s') . '</td></tr>';
            $msg .= '<tr><td style="padding: 5px;"><b>Số điện thoại:</b> ' . $data['bill_phone'] . '</td>';
            $msg .= '<td style="padding: 5px;"><b>Email:</b> <a href="mailto:' . $data['bill_email'] . '">' . $data['bill_email'] . '</a></td></tr>';
            $msg .= '<tr><td style="padding: 5px;"><b>Địa chỉ:</b> ' . $data['bill_address'] . '</td>';
            $msg .= '<td style="padding: 5px;"><b>Tổng giá trị đơn hàng:</b> ' . number_format($data['total_price'], 0, ',', '.') . ' đồng</td></tr></tbody></table>';
            /*
            $msg .= '<p>Vui lòng chuyển khoản giá trị đơn hàng đến:</p>';
            $msg .= '<p>Tài khoản: Nguyễn Văn Long</p>';
            $msg .= '<p>Ngân hàng: Ngân hàng TMCP Ngoại Thương Việt Nam</p>';
            $msg .= '<p>Số tài khoản: 0511000433513</p>';
            $msg .= '<p>Ngân hàng: Ngân hàng ViettinBank</p>';
            $msg .= '<p>Số tài khoản: 0511000433513</p>';
            $msg .= '<p>Khi chuyển khoản vui lòng nêu rõ: Tên, số điện thoại.</p>';
            $msg .= '<p>Chúng tôi sẽ chuyển hàng tới địa chỉ của bạn sau khi nhận được chuyển khoản.</p>';
            */
            $msg .= '<p>Xin cảm ơn !</p>';
        } else {
            $msg = "<p>Dear, " . $data['bill_name'] . ",</p>";
            $msg .= '<p>Thank you for your order. We will ship soon.</p>';
            $msg .= '<table style="border-collapse: collapse; width:100%;"><thead><th style="border: 1px solid #000;" colspan="2">Order detail</th></thead>';
            $msg .= '<tbody style="border: 1px solid #000;">';
            $msg .= '<tr><td style="padding: 5px;"><b>Full name: </b> ' . $data['bill_name'] . '</td>';
            $msg .= '<td style="padding: 5px;"><b>Date order:</b> ' . date('d-m-Y H:i:s') . '</td></tr>';
            $msg .= '<tr><td style="padding: 5px;"><b>Phone number:</b> ' . $data['bill_phone'] . '</td>';
            $msg .= '<td style="padding: 5px;"><b>Email:</b> <a href="mailto:' . $data['bill_email'] . '">' . $data['bill_email'] . '</a></td></tr>';
            $msg .= '<tr><td style="padding: 5px;"><b>Address:</b> ' . $data['bill_address'] . '</td>';
            $msg .= '<td style="padding: 5px;"><b>Total:</b> ' . number_format($data['total_price'], 0, ',', '.') . ' VNĐ</td></tr></tbody></table>';
            /*
            $msg .= '<p>Vui lòng chuyển khoản giá trị đơn hàng đến:</p>';
            $msg .= '<p>Tài khoản: Nguyễn Văn Long</p>';
            $msg .= '<p>Ngân hàng: Ngân hàng TMCP Ngoại Thương Việt Nam</p>';
            $msg .= '<p>Số tài khoản: 0511000433513</p>';
            $msg .= '<p>Ngân hàng: Ngân hàng ViettinBank</p>';
            $msg .= '<p>Số tài khoản: 0511000433513</p>';
            $msg .= '<p>Khi chuyển khoản vui lòng nêu rõ: Tên, số điện thoại.</p>';
            $msg .= '<p>Chúng tôi sẽ chuyển hàng tới địa chỉ của bạn sau khi nhận được chuyển khoản.</p>';
            */
            $msg .= '<p>Thanks you !</p>';
        }
        //'name', 'phone', 'email', 'address', 'total_money'
        $ci->email->from($site->email, $site->title);
        $list = array('dinhduytoan@outlook.com', $site->email);
        $ci->email->to($list);
        $ci->email->subject("Order on website ".$site->title);
        $ci->email->message($msg);
        $ci->email->send();
    }

}