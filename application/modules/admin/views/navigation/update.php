<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h2 class="box-title"><?php echo $subtitle; ?></h2>
            </div>
            <div class="box-body">
                <form id="formEditNav" method="post" class="form-horizontal" accept-charset="utf-8">
                    <input type="hidden" name="id" value="<?php echo $id ?>" />
                    <input type="hidden" name="uri" id="uriStr" value="<?php echo $query_string ?>" />
                    <div class="form-group">
                        <label class="control-label col-md-3">Label item</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="title" value="<?php echo $menu->nav_name ?>" name="nav_name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Menu type</label>
                        <div class="col-md-7">
                            <select id="select01" name="type_menu" class="form-control selectType">
                                <option selected="selected">-- Url type --</option>
                                <option value="0">-- Page --</option>
                                <option value="1">-- Category --</option>
                            </select>
                        </div>
                    </div>
                    <div id="selectResult">

                    </div>
                    <div class="form-group row" id="listPage">
                        <label class="control-label col-md-3">Menu url</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="target" value="<?php echo $menu->nav_slug ?>" name="nav_slug" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <div class="pull-right">
                                <input type="submit" class="btn btn-primary btn-flat" value="Update" />
                                <a href="<?php echo site_url('admin/navigation') ?>" class="btn btn-default btn-flat" title="Về trang quản lý">Back to menu</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    var returnUri = $("#uriStr").val();
    $("#formEditNav").validate({
        rules: {},
        messages: {},
        submitHandler: function (form) {
            $.ajax({
                type: $(form).attr('method'),
                url: site_url + '/admin/navigation/save',
                data: $(form).serialize(),
                beforeSend: function () {
                    $('.box_image_loading').removeClass('hidden');
                },
                success: function (res) {
                    if (res === 'TRUE') {
                        location.href = returnUri;
                    } else {
                        $('.modal-error').show();
                    }
                }
            });
        }
    });
});
</script>