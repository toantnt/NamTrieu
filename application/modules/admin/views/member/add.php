<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
            </div>
            <div class="box-body">

                <form id="formAddCand" name="formMember" method="post" class="form-horizontal" accept-charset="utf-8">
                    <div class="form-group">
                        <input type="hidden" name="uri" id="uriStr" value="<?php echo $query_string ?>" />
                        <label class="control-label col-md-3">Tên đầy đủ</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="member_name" name="member_name" value="<?= set_value('member_name') ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Email</label>
                        <div class="col-md-7">
                            <input class="form-control" type="email" id="member_email" name="member_email" value="<?= set_value('member_email') ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Số điện thoại</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="member_phone" name="member_phone" value="<?= set_value('member_phone') ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Tên đăng nhập</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="member_username" name="member_username" value="<?= set_value('member_username') ?>"/>
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
                        <label class="control-label col-md-3"></label>
                        <div class="col-md-7">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="checkbox" name="member_status" value="1" />
                                    Kích hoạt
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10">
                            <div class="pull-right">
                                <input type="submit" class="btn btn-primary btn-flat" value="Lưu" />
                                <a href="<?php echo site_url('admin/member') ?>" class="btn btn-default btn-flat" title="Về trang quản lý">Về trang quản lý</a>
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
    $("#formAddCand").validate({
        rules: {
            member_name : {
                required : true
            },
            member_email : {
                required : true,
                email: true,
                remote: {
                    url: '/admin/member/checkEmail',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        email: function () {
                            return $('#formAddCand :input[name="member_email"]').val();
                        }
                    }
                }
            },
            member_username : {
                required : true,
                remote: {
                    url: '/admin/member/checkUsername',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        username: function () {
                            return $('#formAddCand :input[name="member_username"]').val();
                        }
                    }
                }
            },
            member_password : {
                required : true,
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
                required : "Tên không được để trống",
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
                required : "Mật khẩu không được để trống",
                minlength: 'Mật khẩu có ít nhất 8 ký tự'
            },
            member_phone : {
                required : "Số điện thoại không được để trống",
                //regex : 'Số điện thoại phải bắt đầu bằng 0 hoặc +84, theo định dạng 01xx-xxxx-xxx hoặc 09x-xxxx-xxx'
                number: 'Vui lòng nhập số'
            }

        },
        submitHandler: function (form) {
            $.ajax({
                type: $(form).attr('method'),
                url: '/admin/member/save',
                data: $(form).serialize(),
                beforeSend: function () {
                    $('.sending').removeClass('hidden');
                },
                success: function (res) {
                    if (res === 'TRUE') {
                        alert('Thêm thành công');
                        location.href = '/admin/member';
                    } else {
                        $('.modal-excel-error').show();
                    }
                }
            });
        }
    });
});
</script>