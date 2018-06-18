<div class="login-box-body">
    <p class="login-box-msg">Đăng nhập quản trị</p>

    <form id="login-form" method="post" accept-charset="utf-8">
        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" id="username" placeholder="Tài khoản" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input id="remember" name="remember_me" value="1" type="checkbox"> Giữ luôn đăng nhập
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
    <!-- /.social-auth-links -->

    <a href="<?php echo site_url('account/forgot') ?>">Quên mật khẩu</a>

</div>