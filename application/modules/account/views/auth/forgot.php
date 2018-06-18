<div class="auth-content">
    <p class="text-center">Khôi phục mật khẩu</p>
    <form id="reset-form" method="post">
        <div class="form-group">
            <label for="email1">Email</label>
            <input type="email" class="form-control underlined" name="email1" id="email1" placeholder="Email đăng ký" required> </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-primary">Đặt lại mật khẩu</button>
            <p class="alertReset invisible" style="color:#007bff;">Password đã được gửi vào email của bạn.</p>
        </div>
        <div class="form-group clearfix">
            <a class="pull-left" href="<?php echo site_url('account/auth') ?>">Về trang đăng nhập</a>
        </div>
    </form>
</div>