<?php


class Jobs extends Admin_Controller {
    private $table = 'tbl_jobs';
    private $id    = 'job_id';
    private $treeJobs;
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('user_agent'));
        $this->load->model('admin_model');
    }

    public function index() {
        $this->data['subtitle'] = 'Các ngành nghề';
        $args = array(
            'table'     => $this->table.", ".$this->table." as tbjobs",
            'select'    => $this->table."*, tbjobs.job_title as parent_title",
            'where'     => "(tbjobs.job_parent = tbl_jobs.id) AND (tbl_jobs.lang_code='$this->admin_lang')",
            'order_by'  => $this->id,
            'get_row'   => false
        );
        $list = $this->admin_model->get($args);
        var_dump($list);
    }

    public function treeList($data, $parent, $step="") {
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

}