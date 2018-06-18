<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
            </div>
            <div class="box-body">

                <form id="formAddNav" method="post" class="form-horizontal" accept-charset="utf-8">
                    <div class="form-group">
                        <input type="hidden" name="uri" id="uriStr" value="<?php echo $query_string ?>" />
                        <label class="control-label col-md-3">Menu label</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="title" name="nav_name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Menu type</label>
                        <div class="col-md-7">
                            <select id="select01" name="type_menu" class="form-control selectType">
                                <option selected="selected">-- Url type --</option>
                                <option value="0">-- Page --</option>
                                <option value="1">-- Category --</option>
                                <!--<option value="2">- Collection -</option>-->
                            </select>
                        </div>
                    </div>
                    <div id="selectResult">

                    </div>
                    <div class="form-group" id="listPage">
                        <label class="control-label col-md-3">Menu url</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="target" name="nav_slug" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10">
                            <div class="pull-right">
                                <input type="submit" class="btn btn-primary btn-flat" value="Save" />
                                <a href="<?php echo site_url('admin/navigation') ?>" class="btn btn-default btn-flat" title="Back to menu">Back to menu</a>
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
    $("#formAddNav").validate({
        rules: { },
        messages: { },
        submitHandler: function (form) {
            $.ajax({
                type: $(form).attr('method'),
                url: '/admin/navigation/save',
                data: $(form).serialize(),
                beforeSend: function () {
                    $('.box_image_loading').removeClass('hidden');
                },
                success: function (res) {
                    if (res === 'TRUE') {
                        location.href = returnUri;
                    } else {
                        $('.modal-excel-error').show();
                    }
                }
            });
        }
    });
});
</script>