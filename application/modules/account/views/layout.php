<!doctype html>
<html class="no-js" lang="en">
	<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title><?php echo ($subtitle == NULL ? 'Account' : $subtitle . ' | Website Managenment') ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="/public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/public/admin/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="/public/admin/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/public/admin/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="/public/admin/plugins/iCheck/square/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <script src="/public/admin/resources/js/jquery.min.js"></script>
        <script src="/public/admin/resources/js/jquery.validate.min.js"></script>
        <style>
            label.error { color: #dd0000; font-weight: normal; }
            .has-feedback label~.form-control-feedback { top: 0 !important; }
        </style>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?php echo site_url() ?>"><b>Admin</b>CMS</a>
            </div>
            <?php $this->load->view($subview, TRUE) ?>
        </div>

        <!-- Bootstrap 3.3.7 -->
        <script src="/public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="/public/admin/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
        <script>
            var site = location.protocol + '//' + location.host;
            $(document).ready(function() {
                $("#login-form").validate({
                    rules: {
                        username: { 
                            required: true,
                            remote: {
                                url: site + '/account/auth/checkUsername',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    username: function () {
                                        return $('#login-form :input[name="username"]').val();
                                    }
                                }
                            }
                        },
                        password: { 
                            required: true,
                            remote: {
                                url: site + '/account/auth/checkPassword',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    password: function () {
                                        return $('#login-form :input[name="password"]').val();
                                    }
                                }
                            }
                        }
                    },
                    messages: { 
                        username: { 
                            required: "Bạn phải nhập tài khoản",
                            remote: "Tên đăng nhập không hợp lệ"
                        },
                        password: { 
                            required: "Bạn phải nhập mật khẩu",
                            remote: "Mật khẩu không hợp lệ"
                        },
                    },
                    submitHandler: function(form) {
                        $.ajax({
                            url: site + '/account/auth/login',
                            type: $(form).attr('method'),
                            data: $(form).serialize(),
                            success: function(res) {
                                if(res === 'TRUE') {
                                    window.location = site + '/admin/dashboard';
                                } else {
                                    $(".alertFailed").removeClass("invisible");
                                    return false;
                                }
                            }
                        });
                    }
                })
            });
            $("#reset-form").validate({
                rules: {
                    email1: { 
                        required: true,
                        email: true,
                        remote: {
                            url: site + '/account/auth/checkEmail',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                email: function () {
                                    return $('#reset-form :input[name="email1"]').val();
                                }
                            }
                        }
                    }
                },
                messages: {
                    email1: {
                        required: "Bạn phải nhập email",
                        email: "Định dạng email không đúng",
                        remote: "Email không tồn tại"
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: site + '/account/auth/send_pass',
                        type: $(form).attr('method'),
                        data: $(form).serialize(),
                        success: function(res) {
                            if(res === 'TRUE') {
                                $(".alertReset").removeClass("invisible");
                            } else { 
                                return false;
                            }
                        }
                    });
                }
            });
        </script>
	</body>
</html>
