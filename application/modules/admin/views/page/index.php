<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <p class="pull-left"><a class="btn btn-info btn-flat" href="<?php echo site_url('admin/page/add') ?>"><i class="glyphicon glyphicon-plus"></i> Create page</a></p>
                <form accept-charset="utf-8" action="<?php echo site_url('admin/page') ?>" method="get" class="form-group">
                    <div class="form-inline pull-right">
                        <input type="text" name="keywords" method="get" class="form-control" placeholder="Page title" />
                        <button class="btn btn-default btn-flat" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="box-body">
                <form method="post" class="form-horizontal" accept-charset="utf-8" action="<?php echo site_url('admin/page/remove') ?>" onsubmit="return confirm('Are you sure to delete ?')">
                    <table class="table table-hover" id="tblPage">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll" /></th>
                                <th>Title</th>
                                <th>Active</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if($list != NULL):
                            foreach($list as $item) {
                        ?>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="cb[]" value="<?php echo $item->page_id ?>" /></td>
                                <td><?php echo $item->page_title ?></td>

                                <td>
                                    <input type="checkbox" id="statusChange"
                                        data-id="<?php echo $item->page_id ?>"
                                        data-value="<?php echo $item->page_active ?>"
                                        <?php echo ($item->page_active == 1 ? 'checked="checked"' : '') ?>
                                    />
                                </td>
                                <td>
                                    <a class="btn btn-info btn-flat" href="<?php echo site_url('admin/page/update/'.$item->page_id) ?>"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger btn-flat" href="<?php echo site_url('admin/page/remove/'.$item->page_id) ?>" onclick="return confirm('Are you sure to delete ?');"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } endif; ?>
                        </tbody>
                    </table>
                    <br />
                    <input type="submit" class="btn btn-danger btn-flat" value="Delete selected" />
                </form>
                <?php echo $links ?>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo CPANEL_PATH.'page/assets/page.js' ?>" type="text/javascript"></script>