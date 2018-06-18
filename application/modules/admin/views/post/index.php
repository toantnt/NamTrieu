<?php //this->load->helper('backend') ?>
<div class="col-md-12">
    <p class="pull-left"><a class="btn btn-default" href="<?php echo site_url('admin/post/add') ?>"><i class="glyphicon glyphicon-plus"></i> Add new</a></p>
</div>
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="col-lg-6">
                <div class="row">
                    <div class="alertForm hidden"></div>
                    <div class="alertFormError hidden"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <form accept-charset="utf-8" action="<?php echo site_url('admin/post/search') ?>" method="get" class="form-group row">
                    <div class="form-inline pull-right">
                        <select name="cat_id" class="form-control">
                            <option value="">Search by category</option>
                            <?php if($catalog != NULL) {
                                foreach($catalog as $cat => $value) {
                                    echo '<option value="'.$cat.'">'.$value.'</option>';
                                }
                            } ?>
                        </select>
                        <input type="text" name="keywords" method="get" class="form-control" placeholder="Post name" />
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </form>
            </div>
            <form method="post" class="form-horizontal" accept-charset="utf-8" action="<?php echo site_url('admin/post/remove') ?>" onsubmit="return confirm('You sure want to delete ?')">
                <table class="table table-hover" id="tblPost">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAll" /></th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Date created</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($list != NULL): 
                        foreach($list as $item) {
                    ?>
                        <tr>
                            <td><input type="checkbox" class="checkbox" name="cb[]" value="<?php echo $item->post_id ?>" /></td>
                            <td><img src="<?php echo $item->post_image ?>" height="40" /></td>
                            <td width="500"><?php echo $item->post_name ?></td>
                            <td><?php 
                            $rs = $this->admin_model->get(array(
                                'table'  => 'tbl_category',
                                'where'  => array(
                                    'cat_id' => $item->cat_id,
                                    'lang_code' => $this->admin_lang
                                ),
                                'get_row' => true
                            ));
                            //$rs = get_category($item->cat_id, $lang); 
                            echo ($rs != NULL ? $rs->cat_name : '');
                            ?></td>
                            <td><?php echo $item->post_created ?></td>
                            <td>
                                <a href="<?php echo site_url('admin/post/update/'.$item->post_id) ?>"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="<?php echo site_url('admin/post/remove/'.$item->post_id) ?>" onclick="return confirm('You sure want to delete ?');"><i class="glyphicon glyphicon-trash"></i></a>
                            </td>
                        </tr>
                    <?php } endif; ?>
                    </tbody>
                </table>
                <br />
                <input type="submit" class="btn btn-primary" value="Delete selected" />
            </form>
            <?php echo $links ?>
        </div>
    </div>
</div>
<script src="<?php echo ADMIN_PATH.'post/assets/post.js' ?>" type="text/javascript"></script>