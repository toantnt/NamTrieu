<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
            </div>
            <div class="box-body">
                <form id="formEditCand" method="post" name="formMember" class="form-horizontal" accept-charset="utf-8">
                    <input type="hidden" name ="member_id" id="member_id" value="<?php echo $candidate->member_id ?>" />
                    <input type="hidden" name="uri" id="uriStr" value="<?php echo $query_string ?>" />
                    <div class="form-group">
                        <label class="control-label col-md-3">Tên đầy đủ</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="member_name" name="member_name" value="<?php echo $candidate->member_name?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Email</label>
                        <div class="col-md-7">
                            <input class="form-control" type="email" id="member_email" name="member_email" value="<?php echo $candidate->member_email?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Số điện thoại</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="member_phone" name="member_phone" value="<?php echo $candidate->member_phone?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Tên đăng nhập</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="member_username" name="member_username" value="<?php echo $candidate->member_username?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Mật khẩu</label>
                        <div class="col-md-3">
                            <input class="form-control" type="password" id="member_password" name="member_password" />
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-default" onclick="return randomString();">Tạo mật khẩu</button>
                            <span class="showPass hidden"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Trạng thái</label>
                        <div class="col-md-7">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="checkbox" name="member_status" value="1" <?php echo ($candidate->member_status == 1 ? 'checked="checked"' : '') ?> />
                                    Kích hoạt
                                </label>
                            </div>
                        </div>
                        <!-- <label class="control-label col-md-3">Candidate status</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="member_status" name="member_status" value="<?= set_value('member_status') ?>"/>
                        </div> -->
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <div class="pull-right">
                                <input type="submit" class="btn btn-primary btn-flat" value="Cập nhật" />
                                <a href="<?php echo site_url('admin/candidate') ?>" class="btn btn-default btn-flat" title="Về trang quản lý">Về trang quản lý</a>
                                <span class="hidden sending"><img src="/public/admin/dist/sending.gif" height="24" alt="" /></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

function randomString() {
    var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
    var string_length = 8;
    var randomstring = '';
    for (var i = 0; i < string_length; i++) {
        var rnum = Math.floor(Math.random() * chars.length);
        randomstring += chars.substring(rnum, rnum + 1);
    }
    document.formMember.member_password.value = randomstring;
    $(".showPass").removeClass('hidden');
    $(".showPass").text(randomstring);
}
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
    var id = $('#member_id').val();
    $("#formEditCand").validate({
        rules: {
            member_name : {
                required : true
            },
            member_email : {
                required : true,
                email: true,
                remote: {
                    url: '/admin/candidate/checkEmail',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: $('#member_id').val(),
                        email: function () {
                            return $('#formEditCand :input[name="member_email"]').val();
                        }
                    }
                }
            },
            member_username : {
                required : true,
                remote: {
                    url: '/admin/candidate/checkUsername',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: $('#member_id').val(),
                        username: function () {
                            return $('#formEditCand :input[name="member_username"]').val();
                        }
                    }
                }
            },
            member_password : {
                minlength:8
                //regex: /^[a-zA-Z0-9]{8,12}$/,
            },
            member_phone : {
                required : true,
                number: true
                //regex: /^(0|\+84)(1[0-9]{2}|9[0-9]{1})\-[0-9]{4}\-[0-9]{3}$/
            }
        },
        messages: {
            member_name : {
                required : "Tên không được để trống"
            },
            member_email : {
                required : "Email không được để trống",
                email: "Định dạng email không hợp lệ",
                remote: "Email đã tồn tại"
            },
            member_username : {
                required : "Tên người dùng không được để trống",
                remote: "Tên người dùng đã tồn tại"
            },
            member_password : {
                minlength: 'Mật khẩu có ít nhất 8 ký tự'
            },
            member_phone : {
                required : "Số điện thoại không được để trống",
                //regex : 'Số điện thoại phải bắt đầu bằng 0 hoặc +84, theo định dạng 01xx-xxxx-xxx hoặc 09x-xxxx-xxx',
                number: true
            }

        },
        submitHandler: function (form) {
            $.ajax({
                type: $(form).attr('method'),
                url: '/admin/candidate/save',
                data: $(form).serialize(),
                beforeSend: function () {
                    $('.sending').removeClass('hidden');
                },
                success: function (res) {
                    if (res === 'TRUE') {
                        alert('Chỉnh sửa thành công');
                        location.href = '/admin/candidate';
                    } else {
                        alert('Lỗi trong quá trình xử lý dữ liệu.')
                    }
                }
            });
        }
    });
});
</script>