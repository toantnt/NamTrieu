
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title" style="width: 100%;">
                    <span class="pull-left"><?php echo $subtitle; ?> - Drag, drop items and then click 'Save'</span>
                    <span class="pull-right">
                        <a href="<?php echo site_url('admin/navigation/add') ?>" class="btn btn-info btn-flat" title="Add menu item"><i class="glyphicon glyphicon-plus"></i> Add menu item</a>
                    </span>
                    <form action="<?php echo site_url('admin/navigation'); ?>" method="get">
                        <span class="pull-right" style="margin-right: 15px;">
                            <select name="group_id" class="form-control" onchange="this.form.submit();">
                                <option value="">Select value</option>
                                <?php if($group != null) {
                                    foreach($group as $item) {
                                        if($item->id == $groupMenu) {
                                            echo '<option value="'.$item->id.'" selected="selected">'.$item->name.'</option>';
                                        } else {
                                            echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                                        }
                                    }
                                } ?>
                            </select>
                        </span>
                    </form>
                </h3>
            </div>
            <div class="box-body">
                <div id="orderResult"></div>

                <button type="submit" role="button" class="btn btn-primary btn-flat" id="btnSave"><i class="fa fa-floppy-o"></i> Save</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            type: 'post',
            url: '/admin/navigation/order_ajax',
            data: {},
            success: function (res) {
                $("#orderResult").html(res);
            }
        });
    });
</script>