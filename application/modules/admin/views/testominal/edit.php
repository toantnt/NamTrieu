<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
            </div>
            <div class="box-body">

                <form id="formAddTest" method="post" class="form-horizontal" accept-charset="utf-8">
                    <div class="form-group">
                        <input type="hidden" name="uri" id="uriStr" value="<?php echo $query_string ?>" />
                        <input type="hidden" name ="testominal_id" id="testominal_id" value="<?php echo $testominal->testominal_id ?>" />
                        <label class="control-label col-md-3">Tên khách hàng</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="testominal_name" name="testominal_name" value="<?php echo $testominal->testominal_name?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Vị trí/Chức vụ</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="testominal_position" name="testominal_position" value="<?php echo $testominal->testominal_position ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Nội dung</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="testominal_content" name="testominal_content" value="<?php echo $testominal->testominal_content ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Hình ảnh</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <input type="text" name="testominal_image" class="form-control" id="ImageUrl" value="<?php echo $testominal->testominal_image ?>" />
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" onclick="return getImage('ImageUrl');"><i class="glyphicon glyphicon-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10">
                            <div class="pull-right">
                                <input type="submit" class="btn btn-primary btn-flat" value="Lưu" />
                                <a href="<?php echo site_url('admin/testominal') ?>" class="btn btn-default btn-flat" title="Back to menu">Về trang quản lý</a>
                                <span class="sending hidden"><img src="/public/admin/dist/sending.gif" height="24" alt=""></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$.validator.addMethod(
    "regex",
    function(value, element, regexp) {
        var check = false;
        return this.optional(element) || regexp.test(value);
    },
    "Please check your input."
);

$(document).ready(function() {
    var returnUri = $("#uriStr").val();
    $("#formAddTest").validate({
        rules: {
            testominal_name : {
                required : true
            },
            testominal_position : {
                required : true,
            },
            testominal_content : {
                required : true,
            },

        },
        messages: { 
            testominal_name : {
                required : "Trường không được để trống",
            },
            testominal_position : {
                required : "Email không được để trống",
            },
            testominal_content : {
                required : "Nội dung không được để trống",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: $(form).attr('method'),
                url: '/admin/testominal/save',
                data: $(form).serialize(),
                beforeSend: function () {
                    $('.sending').removeClass('hidden');
                },
                success: function (res) {
                    if (res === 'TRUE') {
                        setTimeout(function () {
                            $('.sending').addClass('hidden');
                            location.href = '/admin/testominal';
                        }, 1500);
                    } else {
                        alert('Lỗi khi xử lý dữ liệu');
                    }
                }
            });
        }
    });
});
</script>