<?php

class Navigation extends Admin_Controller {
    private $_table = 'tbl_navigation';
    private $_id    = 'nav_id';
    private $treeCat;
    private $treeCategory;
    //private $treeCatalog;
    function __construct() {
        parent::__construct();
        $this->load->model('admin/admin_model');
        $this->load->library('user_agent');
        $this->data['active'] = 'media';
        $this->data['sub_active'] = 'menu';
    }
    public function index() {
        $this->data['subtitle'] = 'Menu';
        $group = $this->input->get('group_id', TRUE);
        if($group == NULL) $group = 1;
        $this->data['groupMenu'] = $group;
        $this->session->set_userdata('group', $group);

        $this->data['group']    = $this->admin_model->get(array(
            'table'    => 'tbl_group_menu',
            'where'    => "lang_code='".$this->admin_lang."'",
            'order_by' => 'id ASC',
            'get_row'  => false
        ));
        $this->data['subview'] = 'admin/navigation/index';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function add() {
        $this->data['query_string'] = $this->agent->referrer();
        $this->data['subtitle'] = 'Add menu item';
        $this->data['subview'] = 'admin/navigation/add';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function update($id) {
        $this->data['subtitle'] = 'Update menu item';
        $this->data['query_string'] = $this->agent->referrer();
        $options = array(
            'table' => $this->_table,
            'where' => array(
                $this->_id => (int) $id
            ),
            'get_row' => true
        );
        $this->data['id'] = $id;
        $this->data['menu'] = $this->admin_model->get($options);

        //$this->data['pages'] = $this->admin_m->get('pages', NULL, 'page_id');
        //$cat = $this->admin_m->get('category');
        //$this->data['category'] = $this->get_category(0, $cat, "");
        $this->data['subview'] = 'admin/navigation/update';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function order_ajax()
    {
        if (isset($_POST['sortable'])) {
            $this->admin_model->save_nav_order($_POST['sortable']);
        }
        $group = $this->session->userdata('group');
        if($group == NULL) $group = 1;
        $options = array(
            'table' => $this->_table,
            'where' => "(lang_code='".$this->admin_lang."') AND (group_id=$group)",
            'order_by' => 'nav_order ASC',
            'get_row' => false
        );
        $menu = $this->admin_model->get($options);
        $this->data['menu'] = $menu; //$this->treeCategory(0, $menu,"");
        $this->load->view('admin/navigation/order_ajax', $this->data);
    }
    public function save() {
        $id = $this->input->post('id', TRUE);
        
        $page_id      = $this->input->post('page_id', TRUE);
        $cat_post_id  = $this->input->post('cat_post_id', TRUE);
        $cat_id       = $this->input->post('cat_id', TRUE);
        
        $data = $this->admin_model->array_from_post(array('nav_name', 'nav_slug'));
        if ($page_id > 0) {
            $data['nav_slug'] = $data['nav_slug'].'-p'.$page_id;
        }
        if ($cat_post_id > 0) {
            $data['nav_slug'] = $data['nav_slug'].'-c'.$cat_post_id;
        }
        if ($cat_id > 0) {
            $data['nav_slug'] = 'collection/'.$data['nav_slug'];
        }
        $data['group_id']  = $this->session->userdata('group');
        $data['lang_code'] = $this->admin_lang;
        $values = array(
            'table' => $this->_table,
            'data'  => $data,
            'primary' => $this->_id,
            'id'    => (isset($id) ? $id : NULL)
        );

        //var_dump($data);
        $saveid = $this->admin_model->save($values);
        if ($saveid > 0) {
            echo 'TRUE';
        } else {
            echo 'FALSE';
        }
    }
    public function delete($id = NULL) {
        $super = $this->session->userdata('web_manager');
        if($super['role'] == '1') {
            if ($id == NULL) {
                $arr_id = $this->input->post('cb', TRUE);
                foreach ($arr_id as $item) {
                    $this->admin_model->delete(array(
                        'table' 	=> $this->_table,
                        'key' 		=> $this->_id,
                        'value' 	=> $item
                    ));
                }
            } else {
                $this->admin_model->delete(array(
                    'table' 	=> $this->_table,
                    'key' 		=> $this->_id,
                    'value' 	=> $id
                ));
            }
        }
        //$str = isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : '';
        redirect($this->agent->referrer());
    }

    public function select($val) {
        $value = $val;
        $str = "";
        // TRANG
        if ($value == 0) {
            $page = $this->admin_model->get(array(
                'table'     => 'tbl_pages',
                'where'     => "lang_code='".$this->admin_lang."'",
                'order_by'  => 'page_id ASC',
                'get_row'   => false
            ));
            $str .= '<div class="form-group row">';
            $str .= '<label class="control-label col-md-3">Select page</label>';
            $str .= '<div class="col-md-7">';
            $str .= '<select name="page_id" id="select01" class="form-control">';
            foreach ($page as $item) {
                $str .= '<option value="' . $item->page_id . '">' . $item->page_title . '</option>';
            }
            $str .= '</select></div>';
            $str .= '<input type="hidden" name="cat_post_id" value="" /> <input type="hidden" name="cat_id" value="" />';
            $str .= '</div>';
        }

        // DANH MỤC TIN TỨC
        if ($value == 1) {
            $options = array(
                'table'     => 'tbl_post_cat',
                'where'     => "lang_code='".$this->admin_lang."'",
                'order_by'  => 'c_id ASC',
                'get_row'   => false
            );
            $cat = $this->admin_model->get($options);
            //var_dump($cat); exit();
            $category = $this->get_cat(0, $cat, "");
            $str .= '<div class="form-group">';
            $str .= '<label class="control-label col-md-3">Select category</label>';
            $str .= '<div class="col-md-7">';
            $str .= '<select name="cat_post_id" id="select01" class="form-control">';
            foreach ($category as $item => $key) {
                $str .= '<option value="' . $item . '">' . $key . '</option>';
            }
            $str .= '</select></div>';
            $str .= '<input type="hidden" name="page_id" value="" /> <input type="hidden" name="cat_id" value="" />';
            $str .= '</div>';
        }

        if ($value == 2) {
            $options = array(
                'table'     => 'tbl_category',
                'where'     => "lang_code='".$this->admin_lang."'",
                'order_by'  => 'cat_id ASC',
                'get_row'   => false
            );
            $cat = $this->admin_model->get($options);
            //var_dump($cat); exit();
            $category = $this->get_category(0, $cat, "");
            $str .= '<div class="form-group">';
            $str .= '<label class="control-label col-md-3">Select category</label>';
            $str .= '<div class="col-md-7">';
            $str .= '<select name="cat_id" id="select01" class="form-control">';
            foreach ($category as $item => $key) {
                $str .= '<option value="' . $item . '">' . $key . '</option>';
            }
            $str .= '</select></div>';
            $str .= '<input type="hidden" name="page_id" value="" /> <input type="hidden" name="cat_post_id" value="" />';
            $str .= '</div>';
        }
        
        echo $str;
    }

    public function get_category($parentid = 0, $data = NULL, $step = "&mdash;") {
        if (isset($data) && is_array($data)) {
            foreach ($data as $val) {
                if ($val->cat_parent == $parentid) {
                    $this->treeCategory[$val->cat_id] = $step . " " . $val->cat_name;
                    $this->get_category($val->cat_id, $data, $step . '&mdash;');
                }
            }
        }
        return $this->treeCategory;
    }

    public function get_cat($parentid = 0, $data = NULL, $step = "&mdash;") {
        if (isset($data) && is_array($data)) {
            foreach ($data as $val) {
                if ($val->c_parent == $parentid) {
                    $this->treeCat[$val->c_id] = $step . " " . $val->c_name;
                    $this->get_cat($val->c_id, $data, $step . '&mdash;');
                }
            }
        }
        return $this->treeCat;
    }

}