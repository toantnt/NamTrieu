<?php 

class Group_Menu extends Admin_Controller {

	private $_table = 'tbl_group_menu';
	private $_id 	= 'id';
	function __construct() {
		parent::__construct();
		$this->load->model('admin/admin_model');
		$this->load->library(array('code_pagination', 'user_agent'));
		$this->data['active'] = 'media';
        $this->data['sub_active'] = 'group_menu';
	}

	public function index() {
		$this->data['subtitle'] = 'Menu category';
		$list 	= $this->admin_model->get(array(
			'table' 	=> $this->_table,
			'where' 	=> array(
				'lang_code' => $this->admin_lang
			),
			'order_by' 	=> $this->_id.' DESC',
			'get_row'	=> false
		));
		$paged = (isset($_GET['page']) ? $_GET['page'] : 1);

        $paginator = new Code_Pagination($list, $paged, 15);
        $paginator->setShowFirstAndLast(true);
        $paginator->setMainSeperator(NULL);
        $this->data['list']      = $paginator->getResults();
        $this->data['paginator'] = '<ul class="pagination">'.$paginator->getLinks($_GET).'</ul>';
		//$result = new

        $this->data['subview'] 	= 'admin/group_menu/index';
        $this->load->view('admin/admin_layout', $this->data);
	}

	public function save() {
        $values = $this->admin_model->array_from_post(array(
            'name', 'position'
        ));
        $values['lang_code'] = $this->admin_lang;
        $id = $this->input->post('id', TRUE);
        $this->admin_model->save(array(
            'table' => $this->_table,
            'data'  => $values,
            'primary' => $this->_id,
            'id'    => (isset($id) ? $id : NULL)
        ));
        redirect('admin/group_menu');
    }

    public function remove($param=NULL) {
        $super = $this->session->userdata('web_manager');
        if($super['role'] == '1') {
            if ($param == NULL) {
                $cb = $this->input->post('cb', TRUE);//tbl_post, $this->table_id, $cb[$i]
                for ($i = 0; $i < count($cb); $i++) {
                    $this->admin_model->delete(array(
                        'table' 	=> $this->_table,
                        'key' 		=> $this->_id,
                        'value' 	=> $cb[$i]
                    ));
                }
            } else {
                $this->admin_model->delete(array(
                    'table' 	=> $this->_table,
                    'key' 		=> $this->_id,
                    'value' 	=> $param
                ));
            }
        }
        redirect('admin/group_menu');
    }
}