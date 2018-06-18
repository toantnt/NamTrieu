<?php 

function getApp($lang) {
    $options = array(
        'table' => 'tbl_options',
        'where' => array(
            'lang_code' => $lang
        ),
        'get_row' => true
    );
    $CI =& get_instance();
    $CI->load->model('home/home_model');
    return $CI->home_model->get($options);
}
function get_menu($uri=NULL, $args=array()) {
    $CI = & get_instance();
    $CI->load->model('home/home_model');

    $str = '';
    $groupMenu = $CI->home_model->get(array(
        'table' => 'tbl_group_menu',
        'where' => "(position='".$args['position']."') AND (lang_code='".$args['lang']."')",
        'get_row' => true
    ));
    //var_dump($groupMenu);
    $options = array(
        'table'   => 'tbl_navigation',
        'select' => 'nav_id, nav_name, nav_slug, nav_order',
        'where' => array(
            'group_id'   => $groupMenu->id,
            'nav_parent' => 0,
            'lang_code'  => $args['lang']
        ),
        'order_by' => 'nav_order ASC',
        'get_row' => false
    );
    $menu = $CI->home_model->get($options);
    if(count($menu) > 0) {
        foreach ($menu as $item) {
            $data = array(
                'table'   => 'tbl_navigation',
                'where' => array(
                    'nav_parent' => $item->nav_id,
                    'lang_code' => $args['lang']
                ),
                'order_by' => 'nav_order ASC',
                'get_row' => false
            );
            $submenu = $CI->home_model->get($data);
            if (!empty($submenu)) {
                if ($item->nav_slug == '#' || $item->nav_slug == NULL) {
                    $sub_active = '';
                    foreach ($submenu as $sub) {
                        if($args['lang'].$sub->nav_slug == $uri) {
                            $sub_active = 'class="active"';
                        }
                    }
                    $str .= '<li '.$sub_active.'>';
                    $str .= '<a href="#" title="' . $item->nav_name . '">' . $item->nav_name . '</a><span></span>';
                } else {
                    $str .= ($uri == $args['lang'].$item->nav_slug ? '<li class="active">' : '<li>');
                    $str .= '<a href="' . site_url($args['lang'].'/'.$item->nav_slug) . '/" title="' . $item->nav_name . '">' . $item->nav_name . '</a> <span></span>';
                }
                $str .= '<ul class="sub_memnu">';
                foreach ($submenu as $sub) {
                    $str .= '<li><a href="' . site_url($args['lang'].'/'.$sub->nav_slug) . '/" title="' . $sub->nav_name . '">' . $sub->nav_name . '</a></li>';
                }
                $str .= '</ul>';
                $str .= '</li>';
            } else {
                $url = $item->nav_slug;
                $name_item = $item->nav_name;
                if($item->nav_slug == '/') {
                    $str .= ($uri == $args['lang'] ? '<li class="active">' : '<li>');
                    $str .= '<a href="' . site_url($lang) . '" title="' . $name_item . '">' . $name_item . '</a>';
                } else  {
                    $str .= ($uri == $args['lang'].$url ? '<li class="active">' : '<li>');
                    if (($item->nav_slug == '#' || $item->nav_slug == NULL)) {
                        $str .= '<a href="#" title="' . $name_item . '">' . $name_item . '</a>';
                    } else {
                        $str .= '<a href="' . site_url($args['lang'].'/'.$url) . '/" title="' . $name_item . '">' . $name_item . '</a>';
                    }
                }
                $str .= '</li>';
            }
        }
    }
    return $str;
}

function mobile_menu($uri=NULL, $args=array()) {
	$CI = & get_instance();
    $CI->load->model('home/home_model');

    $str = '';
    $groupMenu = $CI->home_model->get(array(
        'table' => 'tbl_group_menu',
        'where' => "(position='".$args['position']."') AND (lang_code='".$args['lang']."')",
        'get_row' => true
    ));
    //var_dump($groupMenu);
    $options = array(
        'table'   => 'tbl_navigation',
        'select' => 'nav_id, nav_name, nav_slug, nav_order',
        'where' => array(
            'group_id'   => $groupMenu->id,
            'nav_parent' => 0,
            'lang_code'  => $args['lang']
        ),
        'order_by' => 'nav_order ASC',
        'get_row' => false
    );
    $menu = $CI->home_model->get($options);
    foreach($menu as $item) {
	    $url = $item->nav_slug;
        $name_item = $item->nav_name;
        if($item->nav_slug == '/') {
            if($uri == $args['lang']) { 
            	$str .= '<a class="active" href="' . site_url($lang) . '" title="' . $name_item . '">' . $name_item . '</a>';
            } else {
	            $str .= '<a href="' . site_url($lang) . '" title="' . $name_item . '">' . $name_item . '</a>';
            }
        } else  {
            //$str .= ($uri == $args['lang'].$url ? '<li class="active">' : '<li>');
            if (($item->nav_slug == '#' || $item->nav_slug == NULL)) {
                $str .= '<a href="#" title="' . $name_item . '">' . $name_item . '</a>';
            } else {
                $str .= '<a href="' . site_url($args['lang'].'/'.$url) . '/" title="' . $name_item . '">' . $name_item . '</a>';
            }
        }
    }
    return $str;
}

function get_collection($id, $lang) {
    $options = array(
        'table' => 'tbl_category',
        'where' => array(
            'cat_id'    => $id,
            'lang_code' => $lang
        ),
        'get_row' => true
    );
    $CI =& get_instance();
    $CI->load->model('home/home_model');
    return $CI->home_model->get($options);
}

function get_product($id, $lang) {
    $options = array(
        'table' => 'tbl_product',
        'where' => array(
            'pro_id'    => $id,
            'lang_code' => $lang
        ),
        'get_row' => true
    );
    $CI =& get_instance();
    $CI->load->model('home/home_model');
    return $CI->home_model->get($options);
}
function group_attributes($lang) {
    $CI =& get_instance();
    $CI->load->model('home/home_model');

    $options = array(
        'table' => 'group_attr',
        
        'get_row'   => false,
        'order_by'  => 'ID ASC'
    );
    $result = $CI->home_model->get($options);

    return $result;
}
function list_attributes($id, $lang) {
    $CI =& get_instance();
    $CI->load->model('home/home_model');

    $options = array(
        'table' => 'attributes',
        'where' => array(
            'groupID'     => (int) $id,
            //'lang_code'   => $lang
        ),
        'get_row'   => false,
        'order_by'  => 'ID ASC'
    );
    $result = $CI->home_model->get($options);

    return $result;
}
function get_group_attributes($id) {
    $CI =& get_instance();
    $CI->load->model('home/home_model');

    $options = array(
        'table' => 'product_opitons',
        'where' => array(
            'productID' => $id
            //'lang_code' => $lang
        ),
        'order_by'  => 'ID ASC',
        'group_by'  => 'groupID',
        'get_row'   => false
        
    );

    $result = $CI->home_model->get($options);
    return $result;
}
function get_attributes($id) {
    $CI =& get_instance();
    $CI->load->model('home/home_model');

    $options = array(
        'table' => 'product_opitons',
        'where' => array(
            'productID' => $id
            //'lang_code' => $lang
        ),
        'order_by'  => 'ID ASC',
        'group_by'  => 'groupID',
        'get_row'   => false
        
    );

    $result = $CI->home_model->get($options);
    return $result;
}

function group_attribute($id) {
    $CI =& get_instance();
    $CI->load->model('home/home_model');

    $options = array(
        'table' => 'group_attr',
        'where' => array(
            'ID'     => (int) $id
        ),
        'get_row'   => true,
        'order_by'  => 'ID ASC'
    );
    $result = $CI->home_model->get($options);

    return $result;
}
function product_variables($id) {
    $CI =& get_instance();
    $CI->load->model('home/home_model');
    $result = $CI->home_model->get(array(
        'table'     => 'attributes',
        'where'     => array('groupID' => $id),
        'get_row'   => false
    ));
    return $result;
}

function single_attribute($id) {
    $CI =& get_instance();
    $CI->load->model('home/home_model');

    $options = array(
        'table' => 'attributes',
        'where' => array(
            'ID' => $id,
            //'groupID' => $group_id
        ),
        'get_row'   => true
    );

    $result = $CI->home_model->get($options);
    return $result;
}


function getOptions($id) {
    $CI =& get_instance();
    $CI->load->model('home/home_model');
    
    $result = $CI->home_model->get(array(
        'table' => 'product_opitons',
        'where' => array(
            'productID' => (int) $id
            //'lang_code' => $lang
        ),
        'order_by'=> 'ID ASC',
        'get_row' => false
    ));
    return $result;
}

function getAttribute($id) {
    $CI =& get_instance();
    $CI->load->model('home/home_model');
    $result = $CI->home_model->get(array(
        'table' => 'attributes',
        'where' => array(
            'groupID' => $id
        ),
        'order_by' => 'ID ASC',
        'get_row' => false
    ));
    return $result;
}