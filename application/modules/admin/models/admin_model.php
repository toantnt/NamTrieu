<?php 

class Admin_Model extends MY_Model {

	function __construct() {
		parent::__construct();
	}

    public function update_parent($param)
    {
        $this->db->set(array('cat_parent' => 0));
        $this->db->where('cat_parent', (int)$param['id']);
        $this->db->update($param['table']);
    }
    /*
    public function update_cat($id)
    {
        $this->db->set(array('cat_id' => 1));
        $this->db->where('cat_id', (int)$id);
        $this->db->update('post');
    }
    */

    public function save_nav_order($pages) {
        if (count($pages)) {
            foreach ($pages as $order => $page) {
                if ($page['item_id'] != '') {
                    $data = array(
                        'nav_order' => $order,
                        'nav_parent' => (int) $page['parent_id']
                    );
                    $this->db->set($data)->where('nav_id', $page['item_id'])->update('tbl_navigation');
                }
            }
        }
    }
}