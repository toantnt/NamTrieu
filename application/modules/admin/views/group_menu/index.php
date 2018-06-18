<div class="row">
    <div class="col-lg-12">
        <p class="pull-left"><a href="javascript:;" data-target=".modal-add" data-toggle="modal" class="btn btn-info btn-flat"><i class="glyphicon glyphicon-plus"></i> Add new</a></p>
    </div>
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-body">
                
                <form method="post" class="form-horizontal" accept-charset="utf-8" action="<?php echo site_url('admin/group_menu/remove') ?>" onsubmit="return confirm('Are you sure to delete ?')">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll" /></th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if($list != NULL): 
                            foreach($list as $item) {
                        ?>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="cb[]" value="<?php echo $item->id ?>" /></td>
                                <td><?php echo $item->name ?></td>
                                <td><?php echo $item->position ?></td>
                                
                                <td>
                                    <a class="btn btn-flat btn-info" href="<?php echo site_url('admin/group_menu/update/'.$item->id) ?>" data-id="<?php echo $item->id ?>"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a class="btn btn-flat btn-danger" href="<?php echo site_url('admin/group_menu/remove/'.$item->id) ?>" onclick="return confirm('Are you sure to delete ?');"><i class="glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>
                        <?php } endif; ?>
                        </tbody>
                    </table>
                    <?php echo $paginator ?>
                    <br />
                    <input type="submit" class="btn btn-primary flat" value="Delete selected" />
                </form>
                <?php //echo $links ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-add" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form method="post" id="addGroup" action="<?php echo site_url('admin/group_menu/save') ?>" accept-charset="utf-8">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Group menu</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group row">
                        <label class="label-control col-md-2">Name</label>
                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="label-control col-md-2">Position</label>
                        <div class="col-md-10">
                            <select name="position" class="form-control">
                                <option value="">Select value</option>
                                <option value="main">Main menu</option>
                                <option value="top">Header</option>
                                <option value="bottom">Footer menu</option>
                                <option value="link">Menu links</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#addGroup").validate({
            rules: {
                name: { required: true },
                position: { required: true }
            },
            messages: {}
        });
    });
</script>


