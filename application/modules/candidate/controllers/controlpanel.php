<?php 

/**
* 
*/
class Controlpanel extends Admin_Controller
{
	private $_table = 'tbl_member';
	private $_id = 'member_id';
	function __construct() {
		parent::__construct();
		$this->load->model('admin/admin_model');
		$this->load->library('user_agent');	
		$this->data['active'] = 'member';
	}

	public function index($offset = 0) {
		$this->data['subtitle'] = 'Members';
		$options = array(
			'table' => $this->_table,
			'order_by'	=> $this->_id.' DESC',
			'total'	=> 15,
			'offset'=> $offset
		);
		
		$this->data['list'] = $this->admin_model->get($options);
		$this->dat['paginate'] = $this->ad_pagination($options, 'member/controlpanel', 15);
		$this->data['subview'] = 'member/controlpanel/index';
		$this->load->view('admin/admin_layout', $this->data);
	}
	
	public function update($id) {
		$this->data['subtitle'] = 'Update profile';
		$this->data['id'] = $id;
		$this->data['member'] = $this->admin_model->get(array(
		    'table' => $this->_table,
		    'where' => array($this->_id => $id), 
		    'get_row' => true));
		$this->data['subview'] = 'member/controlpanel/update';//$this->admin_m->get($this->table)
		$this->load->view('admin/admin_layout', $this->data);
	}
	public function save() {
		$id = $this->input->post('id', TRUE);
		$values = $this->admin_model->array_from_post(array(
			'member_name', 'member_email', 'member_phone', 'member_nicename', 'member_password',
			'member_address', 'member_state', 'member_postal_code', 'member_national', 'member_birth',
			'member_status'
		));
		if($values['member_password'] == null) {
			unset($values['member_password']);
		} else {
			$values['member_password'] = md5(md5($values['member_password']));
		}
		$values['member_birth'] = date('Y-m-d', strtotime($values['member_birth']));
		$this->admin_model->save(array(
			'table' => $this->_table,
			'data'	=> $values,
			'primary' => $this->_id,
			'id'	=> $id
		));
		redirect($this->agent->referrer());
	}
	
	public function remove($id=NULL) {
		$user = $this->session->userdata('web_manager');
		//$super = $this->session->userdata('role');
		if($id == NULL) {
		    $data = $this->input->post('cb', TRUE);
		    if($user['role'] == '1') 
		        foreach($data as $value) 
		            //$this->admin_m->delete($this->table_name, $this->primary, $value);
		            $this->admin_model->delete(array(
		                'table'     => $this->_table,
		                'key'       => $this->_id,
		                'value'     => $value
		            ));
		} else {
		    if($user['role'] == '1') 
		        //$this->admin_m->delete($this->table_name, $this->primary, $id);
		        $this->admin_model->delete(array(
		            'table'     => $this->_table,
		            'key'       => $this->_id,
		            'value'     => $id
		        ));
		}
		redirect($this->agent->referrer());
	}
}