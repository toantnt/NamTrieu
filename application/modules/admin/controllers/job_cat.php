<?php

class Job_Cat extends Admin_Controller {
    private $table = 'tbl_job_type';
    private $id = 'jt_id';
    private $treeCat;

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/admin_model');
        $this->load->library('user_agent');
        $this->data['active'] = 'jobs';
    }

    public function index() {
        $this->data['subtitle'] = 'Phân loại ngành nghề';
        $options = array(
            'table' => $this->table,
            'where' => array(
                'lang_code' => $this->admin_lang
            ),
            'order_by' => $this->id.' DESC',
            'get_row'  => false
        );
        $data = $this->admin_model->get($options);
        //var_dump($data); exit();
        $this->data['category'] = $this->tree_category(0, $data, "");
        $this->data['lang'] = $this->admin_lang;
        $this->data['subview'] = 'admin/category/index';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function add() {
        $lang = $this->admin_lang;
        if($lang != 'en') {
            $this->data['list_en'] = $this->admin_model->get(array(
                'table' => $this->table,
                'where' => array(
                    'lang_code' => 'en'
                ),
                'order_by' => $this->id.' ASC',
                'get_row'  => false
            ));
        }

        $this->data['subtitle'] = 'Add category';
        $options = array(
            'table' => $this->table,
            'where' => array(
                'lang_code' => $lang
            ),
            'order_by' => $this->id.' DESC',
            'get_row' => false
        );
        $data = $this->admin_model->get($options);
        $this->data['parent_cat']   = $this->get_category(0, $data, "");
        $this->data['subview']      = 'admin/category/add';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function ajax_insert() {
        $values = $this->admin_model->array_from_post(array(
            'cat_name', 'cat_slug', 'cat_parent',
            'cat_ishome'
        ));
        $values['lang_code'] = $this->admin_lang;
        if($values['cat_ishome'] == NULL) {
            $values['cat_ishome'] = 0;
        }
        $cat_id = $this->admin_model->save(array(
            'table'  => $this->table,
            'data'   => $values,
            'primary'=> $this->id,
            'id'     => NULL
        ));
        if($cat_id > 0) {
            echo json_encode(array(
                'success' => true,
                'message' => 'Create success',
                'url' => 'admin/category'
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'message' => 'System error, please reload page'
            ));
        }
    }
    public function edit($id) {
        $lang = $this->admin_lang;
        if ($lang == null) $lang = 'en';

        if($lang != 'en') {
            $this->data['list_en'] = $this->admin_model->get(array(
                'table' => $this->table,
                'where' => array(
                    'lang_code' => 'en'
                ),
                'order_by' => $this->id.' ASC',
                'get_row'  => false
            ));
        }

        $this->data['id'] = (int) $id;
        $this->data['url'] = $this->agent->referrer();
        $this->data['subtitle'] = 'Update category';
        $options = array(
            'table' => $this->table,
            'where' => array(
                'lang_code' => $lang
            ),
            'order_by' => $this->id.' DESC',
            'get_row' => false
        );
        $data = $this->admin_model->get($options);
        //var_dump($data);
        $this->data['parent_cat'] = $this->get_category(0, $data, "");
        $option_where = array(
            'table' => $this->table,
            'where' => array($this->id => $id, 'lang_code' => $lang),
            'get_row' => true
        );
        $this->data['group'] = $this->admin_model->get( $option_where);

        $this->data['subview'] = 'admin/category/edit';
        $this->load->view('admin/admin_layout', $this->data);
    }
    public function ajax_update() {
        $values = $this->admin_model->array_from_post(array(
            'cat_name', 'cat_slug', 'cat_parent',
            'cat_ishome'
        ));
        $values['lang_code'] = $this->admin_lang;
        if($values['cat_ishome'] == NULL) {
            $values['cat_ishome'] = 0;
        }
        $id = $this->input->post('id', TRUE);
        $cat_id = $this->admin_model->save(array(
            'table'     => $this->table,
            'data'      => $values,
            'primary'   => $this->id,
            'id'        => $id
        ));
        if($cat_id > 0) {
            echo json_encode(array(
                'success' => true,
                'message' => 'Update success',
                'url' => 'admin/category'
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'message' => 'System error, please reload page'
            ));
        }
    }
    public function get_category($parent, $data=NULL, $step="&mdash;") {
        if(isset($data) && is_array($data)){
            foreach($data as $val){
                if($val->cat_parent == $parent)
                {
                    $this->treeCategory[$val->cat_id] = $step." ".$val->cat_name;
                    $this->get_category($val->cat_id, $data, $step.'&mdash;');
                }
            }
        }
        return $this->treeCategory;
    }
    public function tree_category($parent = 0, $data = NULL, $step="") {
        $html = "";
        if(isset($data))
        {
            foreach($data as $val){
                if($val->cat_parent == $parent)
                {
                    $html .= '<tr>';
                    $html .= '<td><input type="checkbox" class="checkbox" name="cb[]" value="'.$val->cat_id.'"></td>';
                    //$html .= '<td><img src="'.$val->image.'" height="40" /></td>';
                    $html .= '<td class="title">'.anchor('admin/category/edit/' . $val->cat_id, $step." ".$val->cat_name, array('id' => 'clickEdit')).'</td>';
                    $html .= '<td>'.$val->cat_slug.'</td>';
                    $html .= '<td><input id="homeStatus" type="checkbox" '.($val->cat_ishome == 0 ? '' : 'checked="checked"').' data-id="'.$val->cat_id.'" data-value="'.($val->cat_ishome == 0 ? 1 : 0).'" /></td>';//($val->cat_status == 1 ? '<td>Hiển thị</td>' : '<td>Ẩn</td>');
                    //$html .= '<td>'.$val->.'</td>';
                    $html .= '<td><a href="'. site_url('admin/category/edit/' . $val->cat_id).'"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;';
                    $html .= '<a href="'.site_url('admin/category/remove/' . $val->cat_id).'" onclick="return confirm(\'You sure want to delete ?\')"><i class="glyphicon glyphicon-trash"></i></a></td>';
                    $html .= '</tr>';
                    $html .= $this->tree_category($val->cat_id, $data, $step.'&mdash;');
                }
            }
        }
        return $html;
    }

    // CHECK insert
    public function check_name() {
        $name = $this->input->post('name', TRUE);
        $options = array(
            'where' => array(
                'name' => $name,
                'type' => 'post'
            ),
            'get_row' => true
        );
        $check = $this->admin_model->get($this->table, $options, $this->id);
        if($check == NULL) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

    public function cat_ishome()
    {
        $cat_id = $this->input->post('cat_id', TRUE);
        $home   = $this->input->post('ishome', TRUE);
        $rs = $this->admin_model->save(array(
            'table'  => $this->table,
            'data'   => array(
                'cat_ishome' => $home
            ),
            'primary'=> $this->id,
            'id'     => $cat_id
        ));
        if($rs > 0) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
    public function remove($id = NULL) {

        $super = $this->session->userdata('web_manager');
        if($super['role'] == '1') {
            if($id==NULL) {
                $arr_id = $this->input->post('cb', TRUE);
                foreach ($arr_id as $item) {
                    if($item!=1) {
                        $this->admin_model->update(array(
                            'table'     => $this->table,
                            'data'      => array(
                                'cat_parent' => 1
                            ),
                            'where'     => array(
                                'cat_parent' => $item
                            )
                        ));
                        $this->admin_model->update(array(
                            'table'     => 'tbl_post',
                            'data'      => array(
                                'cat_id' => 1
                            ),
                            'where'     => array(
                                'cat_id' => $item
                            )
                        ));
                        $this->admin_model->delete(array(
                            'table'     => $this->table,
                            'key'       => $this->id,
                            'value'     => $item
                        ));
                    }
                }

            } else {
                if($id != 1) {

                    $this->admin_model->update(array(
                        'table'     => $this->table,
                        'data'      => array(
                            'cat_parent' => 1
                        ),
                        'where'     => array(
                            'cat_parent' => $id
                        )
                    ));
                    $this->admin_model->update(array(
                        'table'     => 'tbl_post',
                        'data'      => array(
                            'cat_id' => 1
                        ),
                        'where'     => array(
                            'cat_id' => $id
                        )
                    ));
                    $this->admin_model->delete(array(
                        'table'     => $this->table,
                        'key'       => $this->id,
                        'value'     => $id
                    ));
                }
            }
        }
        redirect($this->agent->referrer());
    }
    public function delete($id) {

        if($this->session->userdata('permission') == 1 && $id != 1) {
            $this->admin_model->save(tbl_post, array('cat_id' => 1), 'cat_id', $id);
            $this->admin_model->update_parent($this->table, $id);
            $this->admin_model->delete($this->table, $this->id, (int) $id);
        }
        redirect($this->agent->referrer());
    }
    /*
    public function get_slug($id) {
	    $options = array(
		    'where' => array(
			    'cat_id' => (int) $id
		    ),
		    'get_row' => true
	    );
	    $result = $this->admin_model->get($this->table, $options, $this->id);
	    return $result->cat_slug;
    }
    */
}